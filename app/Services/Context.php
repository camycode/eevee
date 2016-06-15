<?php

/**
 * 上下文服务
 *
 * 在接口业务逻辑中，有很多重复和相同的操作，
 * 上下文服务中对常用操作进行了封装，以简化业务逻辑的开发。
 *
 * @author 古月(2016/03)
 */

namespace App\Services;

use Illuminate\Http\Request;

class Context
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 获取所有GET参数.
     *
     * @return array GET请求参数
     */
    public function params()
    {
        return $this->request->query();
    }

    /**
     * 获取指定GET参数
     *
     * @param $field
     * @param null $default
     *
     * @return array|string
     *
     */
    public function param($field, $default = null)
    {
        return $this->request->query($field, $default);
    }

    /**
     * 获取请求头.
     *
     * @param string $header
     * @param bool $require
     *
     * @return string
     *
     * @throws \Exception
     */
    public function header($header, $require = false)
    {
        $value = $this->request->header($header);

        if (!$value && $require) {

            throw new \Exception("The request header $header is required.", 1);
        }

        return $value;
    }

    /**
     * 获取JSON格式请求数据
     *ß
     * @return array 请求数据数组
     */
    public function data($field = null, $default = null)
    {
        $data = $this->request->json()->all();

        if ($field) {
            return isset($data[$field]) ? $data[$field] : $default;
        }

        return $data;
    }

    /**
     * 响应函数
     * 以JSON格式输出。
     *
     * @param string $result 响应结果
     * @param int $httpCode HTTP状态码
     *
     * @return Response
     */
    public function response($result = '', $httpCode = 200)
    {
        return response(json_encode($result), $httpCode)->header('Content-Type', 'application/json');
    }

    /**
     * 状态响应函数
     *
     * @param $status
     * @param null $data
     * @param int $httpCode
     *
     * @return Status
     */
    public function status($status, $data = null, $httpCode = 200)
    {
        return $this->response(Status::make($status, $data), $httpCode);
    }

}
