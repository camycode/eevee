<?php

namespace Core\Models;

use Core\Services\Status;
use Validator;

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

            $permission_relation_resource = $this->resource('L:PERMISSIONRELATIONSHIP');

            $role_permission_relation_rows = $this->generaRolePermissionRelationRows($this->data['id'], $this->data['permissions']);

            if ($role_permission_relation_rows === false) {
                return status('illegalPermission');
            }

            if (count($role_permission_relation_rows) > 0) {
                $permission_relation_resource->insert($role_permission_relation_rows);
            }

            unset($this->data['permissions']);

            $role_resource->insert($this->data);

            return $this->getRole($this->data['id']);

        });

        return $result;
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

        $permission_resource = $this->resource('L:PERMISSIONRELATIONSHIP');


        $role->permissions = [];

        foreach ($permission_resource->where('role_id', $role_id)->get() as $item) {

            array_push($role->permissions, $item->permission_id);

        }

        return $role ? status('success', $role) : status('roleDoesNotExist');

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
            'permissions' => 'sometimes|array',
        ];

        foreach ($ignore as $field) {
            if (isset($rule[$field])) unset($rule[$field]);
        }


        $messages = [
            'name.unique' => message('roleHasExist'),
            'permissions.array' => message('permissionsMustBeArray'),
        ];

        $validator = Validator::make($this->data, $rule, $messages);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }


    /**
     * 角色初始化
     *
     * @param bool $post
     * @internal param array $role
     */
    protected function initializeRole($post = true)
    {
        $initialized = [
            'id' => $this->id(),
            'status' => config('site.role.default_status', 0),
            'permissions' => [],
            'source' => 'eevee',
        ];

        $this->timestamps($initialized, $post);

        print_r($this->data);

        $this->data = array_merge($initialized, $this->data);

    }

    protected function postPermissions($user_id, $permissions)
    {

    }

    protected function getPermissions($user_id, $permissions)
    {

    }

}
