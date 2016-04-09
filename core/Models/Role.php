<?php

namespace Core\Models;

use Core\Exceptions\StatusException;
use Core\Services\Status;
use Illuminate\Support\Facades\Validator;

class Role extends Model
{

    protected $data = [];

    /**
     * 绑定角色数据
     *
     * @param array $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * 添加角色
     *
     * 成功返回角色对象,包含角色的权限信息.
     *
     * @return Status
     */
    public function addRole()
    {
        $this->validateRole();

        $this->initializeRole();

        return $this->transaction(function () {

            $this->updateRolePermisssions($this->data, $this->data['permissions']);

            $this->filter($this->data, $this->fields('ROLE'));

            $this->resource('ROLE')->insert($this->data);

            $role = $this->getRole($this->data['id']);

            return $role;

        });

    }

    /**
     * 更新角色
     *
     * @param $role_id
     *
     * @return Status
     */
    public function updateRole($role_id)
    {
        $resource = $this->resource('ROLE');

        $origin = $resource->where('id', $role_id)->first();

        if (!$origin) {

            return status('roleDoesNotExist');
        }

        $ignore = [];

        if (isset($this->data['name']) && $this->data['name'] == $origin->name) {

            array_push($ignore, 'name');
        }

        $this->validateRole($ignore);

        $this->timestamps($this->data, false);

        return $this->transaction(function () use ($origin, $resource) {

            if (isset($this->data['permissions'])) {

                $origin->parent = $origin->parent == $this->data['parent'] ? $origin->parent : $this->data['parent'];

                $this->updateRolePermisssions((array)$origin, (array)$this->data['permissions']);

            }

            $this->filter($this->data, $this->fields('ROLE', ['id']));

            $resource->where('id', $origin->id)->update($this->data);

            $role = $this->getRole($origin->id);

            return $role;
        });

    }

    /**
     * 获取角色组
     *
     * @param array $params
     *
     * @return Status
     */
    public function getRoles($params)
    {
        $roles = $this->selector('ROLE', $params);

        return status('success', $roles);
    }

    /**
     * 获取角色
     *
     * @param string $role_id
     *
     * @return Status
     */
    public function getRole($role_id)
    {
        $role_resource = $this->resource('ROLE');

        $role = $role_resource->where('id', $role_id)->first();

        if (!$role) return status('roleDoesNotExist');

        $role->permissions = $this->getRolePermissions($role_id)->data;

        return status('success', $role);

    }

    /**
     * 删除角色
     *
     * @param $role_id
     *
     * @return Status
     */
    public function deleteRole($role_id)
    {
        $resource = $this->resource('ROLE');

        if (!$resource->where('id', $role_id)->first()) {

            return status('roleDoesNotExsit');
        }

        $resource->where('parent', $role_id)->delete();

        return status('success');

    }

    /**
     * 获取角色权限组
     *
     * @param string $role_id
     * @param bool $archive
     *
     * @return Status
     */
    public function getRolePermissions($role_id, $archive = false)
    {
        $items = $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $role_id)->lists('permission_id');

        return $archive ? $this->getRolePermissionsArchive($items) : status('success', $items);

    }

    /**
     * 获取角色权限资源归档
     *
     * @param array $items
     *
     * @return Status
     */
    protected function getRolePermissionsArchive(array $items)
    {

        $permissions = array();

        foreach ($items as $item) {

            if ($permission = $this->resource('PERMISSION')->where('id', $item)->first()) {

                array_push($permissions, $permission);
            }
        }

        $result = array();

        foreach ($permissions as $item) {

            if ($resource = $this->resource('RESOURCE')->where('id', $item->resource_id)->first()) {

                $result[$resource->id]['name'] = $resource->name;
                $result[$resource->id]['parent'] = $resource->parent;
                $result[$resource->id]['description'] = $resource->description;
                $result[$resource->id]['source'] = $resource->source;
                $result[$resource->id]['permissions'] = array();
            }
        }

        foreach ($permissions as $permission) {
            array_push($result[$permission->resource_id]['permissions'], $permission);
        }

        return status('success', $result);
    }


    /**
     * 更新角色权限
     *
     * 更新时会替换角色原有权限.
     *
     * @param array $role
     * @param array $permissions
     * @return Status
     */
    protected function updateRolePermisssions(array $role, array $permissions)
    {

        $permissions = array_unique($permissions);


        $this->transaction(function () use ($role, $permissions) {


            $relationships = $this->generaRolePermissionRelationships($role['id'], $permissions);

            $this->validateRolePermissons($role['parent'], $permissions);

            $this->updateRoleChildrenPermissions($role['id'], $permissions);

            resource('PERMISSIONRELATIONSHIP')->where('role_id', $role['id'])->delete();

            resource('PERMISSIONRELATIONSHIP')->insert($relationships);

        });

    }


    /**
     * 生成角色权限关系记录
     *
     * @param $role_id
     * @param $permissions
     *
     * @return array|bool
     */
    protected function generaRolePermissionRelationships($role_id, array $permissions)
    {
        $data = [];

        foreach ($permissions as $permission_id) {

            $row = [
                'role_id' => $role_id,
                'permission_id' => $permission_id,
            ];

            array_push($data, $row);
        }

        return $data;

    }

    /**
     * 角色验证
     *
     * 要求必须包含`ident`和`name`字段,且值需唯一.
     *
     * @param array $ignore 忽略验证字段
     *
     * @throws StatusException
     */
    protected function validateRole(array $ignore = [])
    {
        $table = $this->table('ROLE');

        $rule = [
            'name' => "required|unique:$table",
            'permissions' => 'sometimes|array',
        ];

        $this->ignore($rule, $ignore);

        $messages = [
            'name.required' => message('roleIsRequired'),
            'name.unique' => message('roleHasExist'),
            'permissions.array' => message('permissionsMustBeArray'),
            'parent.required' => message('roleParentIsRequired'),
        ];

        $validator = Validator::make($this->data, $rule, $messages);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

        if (isset($this->data['parent'])) {

            $this->validateRoleParent($this->data['parent']);
        }


    }


    /**
     * 验证角色父类是否存在
     *
     * @param string $parent_id
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateRoleParent($parent_id)
    {

        if (!$this->resource('ROLE')->where('id', $parent_id)->first() && $this->resource('ROLE')->first()) {

            exception('validateFailed', [
                'parent' => message('parentRoleDoesNotExist'),
            ]);

        }

    }

    /**
     * 获取更新用户权限过程中删除的用户权限
     *
     * @param string $role_id
     * @param array $permissions
     *
     * @return array
     */
    protected function getDeletedPermissions($role_id, array $permissions)
    {
        return array_diff($this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $role_id)->lists('permission_id'), $permissions);
    }

    /**
     * 以角色被删除的权限更新角色的子角色的权限表
     *
     * @param $role_id
     * @param array $permissions
     *
     */
    protected function updateRoleChildrenPermissions($role_id, array $permissions)
    {
        $children = $this->resource('ROLE')->where('id', '<>', $role_id)->where('parent', $role_id)->lists('id');

        $permissions = $this->getDeletedPermissions($role_id, $permissions);

        foreach ($children as $child) {

            foreach ($permissions as $permission) {

                $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $child)->where('permission_id', $permission)->delete();
            }
        }
    }

    /**
     * 验证角色的权限是否超出可设定范围
     *
     * @param string $parent_id
     * @param array $permissions
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateRolePermissons($parent_id, array $permissions)
    {

        if (array_diff($permissions, $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $parent_id)->lists('permission_id'))) {

            exception('invalidPermissions');
        }

    }


    /**
     * 角色初始化
     *
     */
    protected function initializeRole()
    {
        $initialized = [
            'id' => $this->id(),
            'status' => config('site.role.default_status', 0),
            'permissions' => [],
            'source' => 'EEVEE',
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $initialized['parent'] = $initialized['id'];

        $this->timestamps($this->data, true);

        $this->data = array_merge($initialized, $this->data);


    }


}
