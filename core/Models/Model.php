<?php

namespace Core\Models;

use DB;

class Model extends DB
{
    /**
     * 资源数据表.
     *
     * @var array core\System\config\resources.php
     */
    protected $resources;

    public function __construct()
    {
        $this->resources = config('resources');
    }

    /**
     * 生成资源 ID.
     *
     * TODO 检验冲突问题
     *
     * @return string
     */
    public function id()
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
    public function table($resource)
    {
        if (key_exists($resource, $this->resources)) {
            return $this->resources[$resource];
        } elseif (key_exists('L:' . $resource, $this->resources)) {
            return $this->resources['L:' . $resource];
        } else {
            throw new \Exception("Resource table: $resource does not exist.");
        }
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
    public function selector($resource, $params = [])
    {
        $query = $this->resource($resource);

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
    public function resource($resource)
    {
        return DB::table($this->table($resource));
    }


    /**
     * 过滤掉数据的多余字段
     *
     * @param  array $fields
     * @param  array $data
     *
     * @return array
     */
    public function fillable($fields, $data)
    {
        return $data;
    }

    /**
     * 数据库事务处理
     *
     * 在闭包函数中使用`DB`或`Eloquent`作数据库,监听闭包函数异常,操作数据库事务.
     *
     * @param $callback
     *
     * @return mixed 闭包函数的返回结果,或者是操作事务操作失败信息(1003)
     */
    public function transaction($callback)
    {
        DB::beginTransaction();

        try {

            $status = $callback($this);

            if (!isset($status->code) || $status->code == 200) {
                DB::commit();
            } else {
                DB::rollBack();
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return status(1003, $e->getMessage());
        }

        return $status;
    }

    /**
     * 引用传递数组,生成数据库的时间戳字段.
     *
     * @param array $data 记录数组(引用传递)
     * @param bool $post 新增数据(默认为true)
     *
     * @return void
     */
    public function timestamps(&$data, $post = true)
    {
        if ($post) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
    }
}
