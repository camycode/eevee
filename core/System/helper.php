<?php

use Core\Services\Status;

if (!function_exists('result')) {
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
     * @param sting $message
     *
     * @return string
     */
    function message($message)
    {
        return trans("status.$message");
    }
}


