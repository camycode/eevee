<?php

namespace Core\Models;

use Illuminate\Support\Facades\Storage;
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
     * @return \Core\Models\Status
     */
    public function addRole()
    {
        if (($validateResult = $this->validateRole()) !== true) {
            return status('validateError', $validateResult);
        }

        $this->initializeRole();

        $result = $this->transaction(function () {

            $role_resource = $this->resource('ROLE');

            $status = $this->updateRolePermisssions($this->data, $this->data['permissions']);

            if ($status->code != 200) return $status;

            unset($this->data['permissions']);

            $role_resource->insert($this->data);

            return $this->getRole($this->data['id']);

        });

        return $result;
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


        if (($result = $this->validateRole($ignore)) !== true) {
            return status('validateRoleError', $result);
        }

        $this->timestamps($this->data, false);

        $status = $this->transaction(function () use ($origin, $resource) {

            if (isset($this->data['permissions'])) {

                $origin->parent = $origin->parent == $this->data['parent'] ? $origin->parent : $this->data['parent'];

                $status = $this->updateRolePermisssions((array)$origin, $this->data['permissions']);

                if ($status->code != 200) return $status;
            }

            unset($this->data['id']);

            unset($this->data['permissions']);

            $resource->where('id', $origin->id)->update($this->data);

            return $this->getRole($origin->id);
        });

        return $status;
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


        if (!$archive) {
            return status('success', $items);
        }

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

        $resource->where('id', $role_id)->delete();

        return status('success');

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
    protected function updateRolePermisssions($role, $permissions)
    {

        $permissions = array_unique($permissions);

        $data = $this->generaRolePermissionRelationRows($role['id'], $permissions);

        if (count($data) == 0) {
            return status('success');
        }

        $roleParent = $this->resource('ROLE')->where('id', '<>', $role['id'])->where('id', $role['parent'])->first();

        if ($roleParent) {

            $permissionsScope = $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $roleParent->id)->lists('permission_id');

            $outScopePermissions = array_diff($permissions, $permissionsScope);

            if (count($outScopePermissions) > 0) return status('permissionOutOfScope');

        }

        $originPermissions = $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $role['id'])->lists('permission_id');

        $deletePermissions = array_diff($originPermissions, $permissions);

        $roleChildren = $this->resource('ROLE')->where('id', '<>', $role['id'])->where('parent', $role['id'])->lists('id');

        $status = $this->transaction(function () use ($role, $data, $roleChildren, $deletePermissions) {

            foreach ($roleChildren as $child) {

                foreach ($deletePermissions as $permission) {

                    $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $child)->where('permission_id', $permission)->delete();
                }
            }

            $this->resource('L:PERMISSIONRELATIONSHIP')->where('role_id', $role['id'])->delete();

            $this->resource('L:PERMISSIONRELATIONSHIP')->insert($data);

            return status('success');

        });

        return $status;
    }


    /**
     * 生成角色权限关系记录
     *
     * @param $role_id
     * @param $permissions
     *
     * @return array|bool
     */
    protected function generaRolePermissionRelationRows($role_id, $permissions)
    {
        $rows = [];

        $permissions = $permissions == '' ? [] : $permissions;

        foreach ($permissions as $permission_id) {

            $row = [
                'role_id' => $role_id,
                'permission_id' => $permission_id,
            ];

            array_push($rows, $row);
        }

        return $rows;

    }

    /**
     * 角色验证
     *
     * 要求必须包含`ident`和`name`字段,且值需唯一.
     *
     * @param array $ignore 忽略验证字段
     *
     * @return mixed
     *
     * @throws \Exception
     */
    protected function validateRole($ignore = [])
    {
        $table = $this->table('ROLE');

        $rule = [
            'name' => "required|unique:$table",
            'parent' => 'required',
            'permissions' => 'sometimes|array',
        ];

        foreach ($ignore as $field) {
            if (isset($rule[$field])) unset($rule[$field]);
        }

        $messages = [
            'name.required' => message('roleIsRequired'),
            'name.unique' => message('roleHasExist'),
            'permissions.array' => message('permissionsMustBeArray'),
            'parent.required' => message('roleParentIsRequired'),
        ];

        $validator = Validator::make($this->data, $rule, $messages);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if (!$this->resource('ROLE')->where('id', $this->data['parent'])->first() && Storage::has('/storage/install.lock')) {
            return [
                'parent' => message('parentRoleDoesNotExist'),
            ];
        }

        return true;
    }


    /**
     * 角色初始化
     *
     * @internal param bool $post
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

        $this->timestamps($initialized, true);

        $this->data = array_merge($initialized, $this->data);

    }


}
