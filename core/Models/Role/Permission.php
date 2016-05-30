<?php

namespace Core\Models\Role;

use Core\Models\Model;
use Core\Models\Status;

class Permission extends Model
{

    /**
     * 定义数据表依赖
     *
     * @var array
     */
    protected $tables = ['role', 'permission', 'resource'];

    /**
     * 定义数据表字段
     *
     * @var array
     */
    protected $fields = ['role_id', 'permission_id'];

    /**
     * 获取角色权限资源归档
     *
     * 通过查询资源表(resource)获取权限归档信息
     *
     * @param array $items
     *
     * @return Status
     */
    protected function getRolePermissionsArchive(array $items)
    {

        $permissions = array();

        foreach ($items as $item) {

            if ($permission = $this->table('permission')->where('id', $item)->first()) {

                array_push($permissions, $permission);
            }
        }

        $result = array();

        foreach ($permissions as $item) {

            if ($resource = $this->table('resource')->where('id', $item->resource_id)->first()) {

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
     * 更新角色权限时,以其被删除的权限更新其子角色的权限表.
     *
     * @param string $role_id
     * @param array $permissions
     */
    protected function updateRoleChildrenPermissions($role_id, array $permissions)
    {
        $children = $this->table('role')->where('id', '<>', $role_id)->where('parent', $role_id)->lists('id');

        $permissions = $this->getDeletedPermissions($role_id, $permissions);

        foreach ($children as $child) {

            foreach ($permissions as $permission) {

                $this->table()->where('role_id', $child)->where('permission_id', $permission)->delete();
            }
        }
    }

    /**
     * 获取更新用户权限时被删除的权限记录.
     *
     * @param $role_id
     * @param array $permissions
     *
     * @return array
     */
    protected function getDeletedPermissions($role_id, array $permissions)
    {
        return array_diff($this->table()->where('role_id', $role_id)->lists('permission_id'), $permissions);
    }

    /**
     * 验证角色的权限是否超出父角色权限范围, 如果是第一次添加角色, 则忽略验证.
     *
     * @param string $parent_id
     * @param array $permissions
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateRolePermissions($parent_id, array $permissions)
    {

        if (array_diff($permissions, $this->table()->where('role_id', $parent_id)->lists('permission_id'))) {

            if ($this->table()->first()) {

                exception('invalidPermissions');
            }
        }

    }

    /**
     * 生成角色权限关系记录
     *
     * @param $role_id
     * @param array $permissions
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
     * 更新角色权限数
     *
     * @param $role_id
     * @param int $amount
     */
    protected function updateRolePermissionAmount($role_id, $amount)
    {
        $this->table('role')->where('id', $role_id)->update(['permission_amount' => $amount]);
    }


    /**
     * 获取角色权限组
     *
     * @param $role_id
     * @param bool $archive
     *
     * @return Status
     */
    public function getRolePermissions($role_id, $archive = false)
    {
        $items = $this->table()->where('role_id', $role_id)->lists('permission_id');

        return $archive ? $this->getRolePermissionsArchive($items) : status('success', $items);

    }

    /**
     * 保存角色权限
     *
     * 保存时会替换角色原有权限.
     *
     * @param $role_id
     * @param $role_parent
     * @param array $permissions
     *
     * @return Status
     *
     * @throws \Exception
     */
    public function saveRolePermissions($role_id, $role_parent, array $permissions)
    {

        $permissions = array_unique($permissions);

        $this->transaction(function () use ($role_id, $role_parent, $permissions) {

            $relationships = $this->generaRolePermissionRelationships($role_id, $permissions);

            $this->validateRolePermissions($role_parent, $permissions);

            $this->updateRoleChildrenPermissions($role_id, $permissions);

            $this->table()->where('role_id', $role_id)->delete();

            $this->table()->insert($relationships);

            $this->updateRolePermissionAmount($role_id, count($relationships));

        });

    }


}

