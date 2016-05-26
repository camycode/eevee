<?php

/**
 * EEVEE 权限模型
 *
 * 系统权限规则: 每一个用户只能在其所属角色权限范围内操作, 每一个角色拥有的权限数最不超过父角色的权限数.
 *
 * @author 古月
 *
 */

use Core\Models\StaticModel as Model;

class Permission
{

    protected static function validatePermission()
    {
        
    }

    public static function guard()
    {

    }

    public static function getPermission($permission_id)
    {

    }

    public static function getPermissions(array $params)
    {

    }

    public static function addPermission(array $data)
    {
        Model::resource('permission')->add($data);

        return status('success');
    }

    public static function updatePermission(array $data)
    {

    }

    public static function deletePermission($permission_id)
    {

    }


}

