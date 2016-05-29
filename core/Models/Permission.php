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
     * 获取调用者类名.
     *
     * @return array
     */
    protected function get_called_class()
    {
        return explode('\\', str_replace('core\models\\', '', get_called_class()));
    }

    /**
     * 权限验证函数
     *
     * 第一参数是需要检测的数据数组，第二个参数定义是否为读取数据操作，第三个参数标识数据数组中用户 ID 的字段
     * 此函数会以调用处父函数名、父类名、和系统 VISITOR_ROLE_ID 常量去判断访问用户的操作权限。$read 为 false 时，
     * 如果用户没有操作权限，会抛出 1002 状态异常状态码。否则只过滤掉不合法数据，不抛出异常，函数返回 false。
     *
     * @param mixed $data 受保护的数据
     * @param int $action 操作动作      GUARD_ADD | GUARD_UPDATE | GUARD_GET | GUARD_DELETE
     * @param string $action_name 操作动作名称
     * @param string $user_field 用户标识字段
     * @param string $term_field 分类标识字段
     */
    public static function guard($data, $action, $action_name, $user_field = 'user_id', $term_field = 'term_id')
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

