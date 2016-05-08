<?php

use Core\Services\Status;
use Core\Exceptions\StatusException;

/**
 * 返回操作结果集,包含状态码,响应消息和响应数据.
 *
 * @param string / int $status
 * @param null $data
 *
 * @return \Core\Models\Status
 *
 */
function status($status, $data = null)
{
    return Status::make($status, $data);
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
 *
 * @throws StatusException
 */
function exception($status, $data = null)
{
    throw new StatusException(status($status, $data));
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

function auth($permission, $resource, $role_id, $callback)
{
    
}
