<?php

namespace Core\Models;

use Illuminate\Support\Facades\DB;

class Model
{
    /**
     * 资源数据表.
     *
     * @var array core\System\config\resources.php
     */
    protected static $resources;

    protected static function setResources()
    {
        self::$resources = config('resources');
    }

    /**
     * 生成资源 ID.
     *
     * TODO 检验冲突问题
     *
     * @return string
     */
    public static function id()
    {
        return md5(sha1(uniqid(mt_rand(1, 1000000))));
    }

    /**
     * 获取资源的数据表名
     *
     * @param string $resource
     *
     * @return string
     *
     * @throws \Exception
     */
    public static function table($resource)
    {
        return self::getResourceInfo($resource, 'table');
    }

    /**
     * 获取资源数据表字段
     *
     * @param $resource
     *
     * @return array
     *
     * @throws \Exception
     */
    public static function fields($resource)
    {
        return self::getResourceInfo($resource, 'fields');
    }

    /**
     * 资源查询构造器.
     *
     * 支持`order`,`offset`,`limit`,`fields`,`group`,`count`,`first`等条件筛选.
     *
     *
     * @param string $resource 资源标识符
     * @param array $params 查询参数
     *
     * @return mixed 数据库查询结果
     *
     */
    public static function selector($resource, array $params = [])
    {
        $query = self::resource($resource);

        foreach ($params as $action => $param) {

            switch ($action) {
                case 'order':
                    $options = explode(':', $param);
                    $query = $query->orderBy($options[0], $options[1]);
                    break;
                case 'offset':
                    $query = $query->skip($param);
                    break;
                case 'limit':
                    $query = $query->take($param);
                    break;
                case 'fields':
                    $query = $query->lists($param);
                    break;
                case 'group':
                    $query = $query->groupBy($param);
                    break;
                case 'count':
                case 'first':
                    break;
                default:
                    $query = $query->where($action, $param);

            }
        }

        return isset($params['count']) ? $data = $query->count() : $data = $query->get();
    }

    /**
     * 获取资源数据库操作对象
     *
     * @param string $resource
     *
     * @return object
     */
    public static function resource($resource)
    {
        return DB::table(self::table($resource));
    }


    /**
     * 过滤掉数据的多余字段
     *
     * @param  array $data     原始数据
     * @param  array $fields   保留字段
     * @param  array $ignore   强制过滤字段
     *
     * @return array
     */
    public static function filter(array &$data, array $fields, array $ignore = [])
    {
        $fields = array_diff($fields, $ignore);

        foreach ($data as $k => $v) {
            if (!in_array($k, $fields)) {
                unset($data[$k]);
            }
        }

        return $data;
    }

    /**
     * 忽略数组字段
     *
     * 忽略掉传入数组中标示的字段,即过滤掉相关字段.
     *
     * @param array &$data   传入数据
     * @param array $fields  过滤字段
     *
     * @return void
     */
    public static function ignore(array &$data, array $fields)
    {
        foreach ($fields as $field) {

            if (isset($data[$field])) unset($data[$field]);
        }
    }

    /**
     * 数据库事务处理
     *
     * 在闭包函数中使用`DB`或`Eloquent`作数据库,监听闭包函数异常,操作数据库事务.
     * 闭包函数中产生的任何异常都会引起数据操作失败,事务回滚.
     *
     * @param $callback
     *
     * @return Status 闭包函数的返回结果,或者是操作事务操作失败信息(1003)
     *
     * @throws \Exception
     */
    public static function transaction($callback)
    {
        DB::beginTransaction();

        try {

            $status = $callback();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }

        return $status;
    }

    /**
     * 引用传递数组,生成数据库的时间戳字段.
     *
     * @param array $data 数据数组(引用传递)
     * @param bool $post 新增数据(默认为true,默认生成 created_at 字段)
     *
     * @return void
     */
    public static function timestamps(array &$data, $post = true)
    {
        if ($post) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
    }

    /**
     * 获取资源信息
     *
     * 1. 根据传入的 "资源标识符" 和 "资源信息标志符" 获取资源信息,
     * 2. 处理"逻辑资源"的前缀省略的自动识别.
     *
     * @param string $resource 资源标识符
     * @param string $key 资源信息标志符
     *
     * @return string
     *
     * @throws \Exception
     */
    protected static function getResourceInfo($resource, $key)
    {
        $resource = strtoupper($resource);

        self::setResources();

        if (key_exists($resource, self::$resources)) {

            return isset(self::$resources[$resource][$key]) ? self::$resources[$resource][$key] : '';

        } elseif (key_exists('L:' . $resource, self::$resources)) {

            return isset(self::$resources['L:' . $resource][$key]) ? self::$resources['L:' . $resource][$key] : '';

        } else {

            throw new \Exception("Resource table: $resource does not exist.");

        }
    }

}
