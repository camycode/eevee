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

/**
 * 遍历目录
 *
 * @param string $dir 遍历目标目录路径
 * @param bool $all 是否递归遍历
 *
 * @return array
 */
function list_dir($dir, $all = false)
{
    $dirs = array();

    if (is_dir($dir)) {

        if ($handler = opendir($dir)) {

            while (($file = readdir($handler)) !== false) {

                $path = $dir . "/" . $file;

                if ((is_dir($path)) && $file != "." && $file != "..") {

                    array_push($dirs, $path);

                    if ($all) {
                        list_dir("$path/");
                    }
                }
            }
            closedir($handler);
        }
    }

    return $dirs;
}
