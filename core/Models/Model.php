<?php

namespace Core\Models;

use Illuminate\Support\Facades\DB;

class Model
{


    /**
     * @var $data array 模型操作数据
     */
    protected $data;

    /**
     * 构造函数,绑定操作数据
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
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
     * @param null $name 指定表明
     *
     * @return DB
     */
    public function table($name = null)
    {
        $name = $name || $this->tableName();

        return DB::table($name);
    }

    /**
     * 获取模型数据库表命, 模型的数据表名称与模型路径保持一致
     *
     * Models/User.php          对应数据表为 user;
     * Models/User/Config.php   对应数据表为 user_config;
     *
     * @return string
     */
    public function tableName()
    {
        return strtolower(__CLASS__);
    }


    /**
     * 资源查询构造器.
     *
     * 支持`order`,`offset`,`limit`,`fields`,`group`,`count`,`first`等条件筛选.
     *
     *
     * @param array $params     查询参数
     * @param null  $tableName  数据表名称
     *
     * @return mixed 数据库查询结果
     *
     */
    public function selector(array $params = [], $tableName = null)
    {
        $tableName = $tableName || $this->tableName();

        $query = $this->table($tableName);

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
     * 过滤掉数据的多余字段
     *
     * @param  array $fields
     * @param  array $data
     *
     * @return array
     */
    public function filter(array &$data, array $fields, array $ignore = [])
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
     * @param array &$rule
     * @param array $fields
     */
    public function ignore(&$rule, $fields)
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

        } catch (\Exception $e) {

            DB::rollBack();

            throw $e;
        }

        return $status;
    }

    /**
     * 获取时间戳
     *
     * @return string
     */
    public function timestamp()
    {
        return date('Y-m-d H:i:s');
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
