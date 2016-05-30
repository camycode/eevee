<?php

/**
 * 角色模型
 *
 *
 */

namespace Core\Models;

use Core\Exceptions\StatusException;
use Illuminate\Support\Facades\Validator;
use Core\Models\Role\Permission as RolePermission;

class Role extends Model
{

    protected $fields = ['id', 'app_id', 'name', 'description', 'parent', 'user_amount', 'permission_amount', 'status', 'created_at', 'updated_at'];

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
        ];

        $initialized['parent'] = $initialized['id'];

        $this->timestamps($this->data, true);

        $this->data = array_merge($initialized, $this->data);

    }

    /**
     * 角色验证
     *
     * @param array $ignore 忽略验证字段
     *
     * @throws StatusException
     */
    protected function validateRole(array $ignore = [])
    {
        $table = $this->tableName();

        $rule = [
            'app_id' => "required",
            'name' => "required|unique:$table",
            "parent" => 'required'
        ];

        $this->ignore($rule, $ignore);

        $messages = [
            'app_id.required' => message('appIDIsRequired'),
            'name.required' => message('roleIsRequired'),
            'name.unique' => message('roleHasExist'),
            'parent.required' => message('roleParentIsRequired'),
        ];

        $validator = Validator::make($this->data, $rule, $messages);

        if ($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

        if (isset($this->data['permissions']) && !is_array($this->data['permissions'])) {

            exception('validateFailed', [
                'permissions' => message('permissionsMustBeArray'),
            ]);
        }

        if (isset($this->data['parent'])) {

            $this->validateRoleParent($this->data['parent']);
        }

    }

    /**
     * 角色表不为空时, 验证角色父类是否存在, 第一次添加角色时, 忽略验证.
     *
     * @param string $parent_id
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateRoleParent($parent_id)
    {

        if (!$this->table()->where('id', $parent_id)->first() && $this->table()->first()) {

            exception('validateFailed', [
                'parent' => message('parentRoleDoesNotExist'),
            ]);

        }

    }

    /**
     * 获取角色
     *
     * @param string $id
     *
     * @return Status
     */
    public function getRole($id)
    {

        if ($role = $this->table()->where('id', $id)->first()) {

            $role->permissions = (new RolePermission())->getRolePermissions($id)->data;

            $this->guard($role, 'get', GUARD_GET);

            return status('success', $role);
        }

        exception('roleDoesNotExist');

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
        $roles = $this->selector($params);

        $this->guard($roles, 'get', GUARD_GET);

        return status('success', $roles);
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

        $this->guard($this->data, 'add', GUARD_ADD);

        return $this->transaction(function () {

            $permissions = $this->data['permissions'];

            $this->filter($this->data, $this->fields);

            $this->table()->insert($this->data);

            (new RolePermission())->saveRolePermissions($this->data['id'], $this->data['parent'], $permissions);

            $role = $this->getRole($this->data['id']);

            return $role;

        });

    }

    /**
     * 更新角色
     *
     * @param $id
     *
     * @return Status
     */
    public function updateRole($id)
    {

        $origin = $this->getRole($id)->data;

        $this->guard($this->data, 'add', GUARD_UPDATE);

        $ignore = [];

        if (isset($this->data['name']) && $this->data['name'] == $origin->name) {

            array_push($ignore, 'name');
        }

        $this->validateRole($ignore);

        $this->timestamps($this->data, false);

        return $this->transaction(function () use ($origin) {

            if (isset($this->data['permissions'])) {

                $origin->parent = $origin->parent == $this->data['parent'] ? $origin->parent : $this->data['parent'];

                (new RolePermission())->saveRolePermissions($this->data['id'], $this->data['parent'], (array)$this->data['permissions']);

            }

            $this->filter($this->data, $this->fields, ['id']);

            $this->table()->where('id', $origin->id)->update($this->data);

            $status = $this->getRole($origin->id);

            return $status;

        });

    }

    /**
     * 删除角色
     *
     * @param $id
     *
     * @return Status
     */
    public function deleteRole($id)
    {

        if ($role = $this->getRole($id)) {

            $this->guard($role, 'delete', GUARD_DELETE);

            $this->table()->where('id', $id)->delete();

            return status('success');

        }

        return status('roleDoesNotExsit');

    }


}
