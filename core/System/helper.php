<?php

use Core\Services\Status;
use Core\Exceptions\StatusException;


define('GUARD_ADD', 'add');                             // 增加
define('GUARD_DELETE', 'delete');                       // 删除
define('GUARD_GET', 'get');                             // 获取
define('GUARD_UPDATE', 'update');                       // 更新
define('GUARD_SAVE', 'save');                           // 保存

define('STATUS_FORBIDDEN', 'forbidden');                // 禁用
define('STATUS_ACTIVE', 'active');                      // 使用中
define('STATUS_PUBLIC', 'public');                      // 公开
define('STATUS_PRIVATE', 'private');                    // 认证中
define('STATUS_VALIDATED', 'validated');                // 认证成功
define('STATUS_VALIDATE_FAILED', 'validate_failed');    // 认证失败


/**
 * 返回操作结果集,包含状态码,响应消息和响应数据.
 *
 * @param string / int $status
 * @param null $data
 * @param null $message
 *
 * @return \Core\Models\Status
 */
function status($status, $data = null, $message = null)
{
    return Status::make($status, $data, $message);
}

/**
 * 获取系统默认文案
 *
 * @param string $ident
 *
 * @return string
 */
function text($ident)
{
    return trans("system.$ident");
}

/**
 * 获取响应消息
 *
 * @param string $message
 *
 * @return string
 */
function message($message)
{
    return trans("messages.$message");
}

/**
 * 响应异常状态操作
 *
 *
 * @param array $status
 * @param mixed $data
 * @param string $message
 *
 * @throws StatusException
 */
function exception($status, $data = null, $message = null)
{
    throw new StatusException(status($status, $data, $message));
}

/**
 *
 * 获取本地化文件名称属性
 *
 * @param $ident
 *
 * @return null|string
 */
function trans_name($ident)
{
    $item = trans($ident);

    if (is_array($item)) {

        return isset($item['name']) ? $item['name'] : null;
    }

    return $item;
}


/**
 * 调试打印函数
 *
 * @param mixed $var
 */
function d($var)
{
    die(json_encode($var));
}


/**
 * 生成插件和主题静态资源链接
 *
 * @param atring $path
 */
function asset($path)
{
    d(__DIR__);
}

/**
 * 接口权限验证函数
 *
 * @param $permission
 * @param $resource
 * @param $user_id
 * @param $callback
 */
function auth($permission, $resource, $user_id, $callback)
{

}
