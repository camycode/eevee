<?php

namespace Core\Controllers;

use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{


    /**
     * 生成唯一标识符
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
     * @param null $name 指定表明
     *
     * @return DB
     */
    public function table($name)
    {
        return DB::table($name);
    }

    /**
     * 资源查询构造器.
     *
     * 支持`order`,`offset`,`limit`,`fields`,`group`,`count`,`first`等条件筛选.
     *
     *
     * @param string $table 数据表名称
     * @param array $params 查询参数
     *
     * @return mixed 数据库查询结果
     *
     */
    public function selector($table, array $params = [])
    {
        $query = $this->table($table);

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
     * 过滤掉数据的多余字段.
     *
     * @param  array $data
     * @param  array $fields
     * @param  array $ignore
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function filter(array &$data, array $fields, array $ignore = [])
    {
        $fields = array_diff($fields, $ignore);

        foreach ($data as $k => $v) {

            if (!in_array($k, $fields)) {

                unset($data[$k]);
            }

        }

        if (!$data) {

            exception('InvalidData');
        }

    }

    /**
     * 忽略数组字段
     *
     * @param array &$rule
     * @param array $fields
     */
    public function ignore(&$rule, array $fields)
    {
        foreach ($fields as $field) {

            if (isset($rule[$field])) unset($rule[$field]);
        }
    }

    /**
     * 数据库事务处理
     *
     * 在闭包函数中使用`DB`或`Eloquent`作数据库,监听闭包函数异常,操作数据库事务.
     *
     * @param $callback
     * @return mixed 闭包函数的返回结果,或者是操作事务操作失败信息(1003)
     *
     * @throws \Exception
     */
    public function transaction($callback)
    {
        DB::beginTransaction();

        try {

            $status = $callback($this);

            DB::commit();

        } catch (\Exception $error) {

            DB::rollBack();

            throw $error;
        }

        return $status;
    }

    /**
     * 获取日期时间戳
     *
     * @return string
     */
    public function timestamp()
    {
        return date('Y-m-d H:i:s');
    }

}
