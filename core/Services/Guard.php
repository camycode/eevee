<?php

namespace Core\Services;

class Guard
{

    /**
     * 权限验证函数
     *
     * 第一参数是需要检测的数据数组，第二个参数定义是否为读取数据操作，第三个参数标识数据数组中用户 ID 的字段
     * 此函数会以调用处父函数名、父类名、和系统 VISITOR_ROLE_ID 常量去判断访问用户的操作权限。$read 为 false 时，
     * 如果用户没有操作权限，会抛出 1002 状态异常状态码。否则只过滤掉不合法数据，不抛出异常，函数返回 false。
     *
     * @param mixed $data 受保护的数据
     * @param string $action_name 操作动作名称
     * @param int $action_tag 操作动作      GUARD_ADD | GUARD_UPDATE | GUARD_GET | GUARD_DELETE | GUARD_SAVE
     * @param null $callback 回调函数,根据回调函数返回的bool值, 作为权限判定是否通过的最终依据.
     * @param string $user_field 用户标识字段
     * @param string $type_field 资源分类标识字段
     */
    public static function make($data, $action_name, $action_tag, $callback = null, $user_field = 'user_id', $type_field = 'type_id')
    {

    }

    /**
     * 获取调用者类名.
     *
     * @return array
     */
    protected static function get_called_class_name()
    {
        return explode('\\', str_replace('core\models\\', '', get_called_class()));
    }

}