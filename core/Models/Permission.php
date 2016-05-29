<?php

/**
 * EEVEE 权限模型
 *
 * 系统权限规则: 每一个用户只能在其所属角色权限范围内操作, 每一个角色拥有的权限数最不超过父角色的权限数.
 *
 * @author 古月
 *
 */

namespace Core\Models;


class Permission
{
    /**
     * 验证权限
     */
    protected static function validatePermission()
    {

    }
    

    /**
     * 获取系统权限记录
     *
     * @param $permission_id
     *
     * @return \Core\Models\Status
     *
     * @throws \Core\Exceptions\StatusException
     */
    public static function getPermission($permission_id)
    {
        if ($permission = Model::resource('permission')->where('id', $permission_id)->first()) {

            self::guard((array)$permission);

            return status('success', $permission);
        }

        exception('PermissionDoesNotExist');

    }


    public static function getPermissions(array $params)
    {

    }


    public static function addPermission(array $data)
    {
        self::guard($data);

        Model::resource('permission')->add($data);

        return status('success');
    }

    public static function updatePermission(array $data)
    {
        self::guard($data);

    }

    /**
     * 删除系统权限记录
     *
     * @param $permission_id
     *
     * @return \Core\Models\Status
     */
    public static function deletePermission($permission_id)
    {
        $permission = self::getPermission($permission_id)->data;

        self::guard((array)$permission);

        Model::resource('permission')->where('id', $permission_id)->delete();

        return status('success');

    }


}

