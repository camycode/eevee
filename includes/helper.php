<?php


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
    return \Core\Services\Status::make($status, $data);
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
    return trans("messages.$message") ? trans("messages.$message") : $message;
}

/**
 * 响应异常状态操作
 *
 *
 * @param string / int $status
 * @param mixed $data
 *
 * @throws \Core\Exceptions\StatusException
 */
function exception($status, $data = null)
{
    throw new \Core\Exceptions\StatusException(status($status, $data));
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
function d($var = [])
{
    die(json_encode($var));
}


/**
 * 注册钩子全局对象
 */

global $hook;

$hook = new \Core\Services\Hook();

/**
 * 生成权限校验对象
 *
 * @return Rbac
 */
function rabc()
{
    return new \Core\Services\Rbac();
}

/**
 * 绑定钩子函数
 *
 * @param $tag
 * @param $function_to_add
 * @param int $priority
 * @param int $accepted_args
 */
function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1)
{

    global $hook;

    $hook->add_action($tag, $function_to_add, $priority, $accepted_args);
}

/**
 * 触发钩子函数
 *
 * @param $tag
 * @param string $arg
 */
function do_action($tag, $arg = '')
{

    global $hook;

    $hook->do_action($tag, $arg);
}


/**
 * 获取GET参数
 *
 * @param null $key
 *
 * @return null
 */
function get_query($key = null)
{
    if ($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    return $_GET;
}


/**
 * 加载样式文件
 *
 * @param $path
 */
function load_style($path)
{
    echo '<link rel="stylesheet" type="text/css" href="' . $path . '" />';
}

/**
 * 加载脚本文件
 *
 * @param $path
 */
function load_script($path)
{
    echo '<script type="text/javascript" src="' . $path . '"></script>';
}

/**
 * 加载插件样式文件
 *
 * @param $path
 */
function load_plugin_style($path)
{
    load_style("/content/plugins/$path");
}

/**
 * 加载插件脚本文件
 *
 * @param $path
 */
function load_plugin_script($path)
{
    load_script("/content/plugins/$path");
}


/**
 * 加载视图组件
 *
 * @param $name
 * @throws Exception
 */
function load_component($name)
{
    $file = base_path("content/plugins/core/components/$name.php");

    if (file_exists($file)) {

        include $file;

    } else {

        throw new \Exception('The component is not exist at: ' . $file);

    }
}

/**
 * 获取数组指定值
 *
 * @param array $array
 * @param mixed $key
 * @param null $default
 *
 * @return mixed|null
 */
function array_value(array  $array, $key, $default = null)
{
    return isset($array[$key]) ? $array[$key] : $default;
}

/**
 * 加载边栏菜单
 *
 * @param array $menu
 * @param array $sub_menus
 */
function load_side_menu(array $menu, array $sub_menus = null)
{

    if (!$sub_menus) {
        echo '<li class="item"><a href="' . array_value($menu, 'link') . '"><i class="' . array_value($menu, 'icon') . '"></i>' . array_value($menu, 'name') . '</a></li>';
    } else {
        echo '<li class="item"><a href="' . array_value($menu, 'link') . '"><i class="' . array_value($menu, 'icon') . '"></i>' . array_value($menu, 'name') . '</a>';
        echo '<ul>';
        foreach ($sub_menus as $sub_menu) {

            if (is_array($sub_menu)) {
                echo '<li class="item"><a href="' . array_value($sub_menu, 'link') . '">' . array_value($sub_menu, 'name') . '</a></li>';
            }
        }
        echo '</ul>';
        echo '</li>';
    }
}

/**
 * 生成唯一标识符
 *
 * @return string
 */
function id()
{
    return md5(sha1(uniqid(mt_rand(1, 1000000))));
}

/**
 * 数据验证函数
 *
 * @param array $data 验证数据
 * @param array $rule 验证规则
 * @param array $message 自定制响应消息
 *
 * @return bool
 */
function validate(array $data, array $rule, array $message = [])
{
    $validator = \Illuminate\Support\Facades\Validator::make($data, $rule, $message);

    if ($validator->fails()) {

        return $validator->errors();
    }

    return true;
}


/**
 * 获取资源的数据表名
 *
 * @param null $name 指定表明
 *
 * @return \Illuminate\Support\Facades\DB
 */
function table($name)
{
    return \Illuminate\Support\Facades\DB::table($name);
}

/**
 * 获取数据库机构生成器
 *
 * @return \Illuminate\Support\Facades\Schema
 */
function schema()
{
    return \Illuminate\Support\Facades\Schema::class;
}

/**
 * 设置其他数据库连接
 *
 * 如果两个连接命名相同,且配置不同,则会抛出异常。
 *
 * @param string $name
 * @param array $value
 * @throws Exception
 */
function set_connection($name, array $value)
{
    
    $connections = config('database.connections');

    if (array_value($connections, $name) === null) {

        \Illuminate\Support\Facades\Config::set('database.connections.' . $name, $value);

    } else {

        if (count(array_diff($connections[$name], $value)) > 0) {

            throw new \Exception("Database connection \"$name\" has exists.");
        }

    }

}

/**
 * 连接其他数据库服务器
 *
 * @param string $name 配置的名称
 *
 * @return \Illuminate\Support\Facades\DB
 */
function connection($name)
{
    return \Illuminate\Support\Facades\DB::connection($name);
}

/**
 * 资源查询构造器.
 *
 * 支持`order`,`offset`,`limit`,`fields`,`group`,`count`,`first`等条件筛选.
 *
 *
 * @param mixed $table 数据表名称
 * @param array $params 查询参数
 *
 * @return mixed 数据库查询结果
 *
 */
function selector($table, array $params = [])
{
    $query = is_string($table) ? table($table) : $table;

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
 * @param  array $data 原始数据
 * @param  array $fields 保留字段
 * @param  array $ignore 强制过滤字段
 *
 */
function filter_fields(array &$data, array $fields, array $ignore = [])
{
    $fields = array_diff($fields, $ignore);

    foreach ($data as $k => $v) {

        if (!in_array($k, $fields)) {

            unset($data[$k]);
        }

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
function transaction($callback)
{
    DB::beginTransaction();

    try {

        $status = $callback();

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
function timestamp()
{
    return date('Y-m-d H:i:s');
}


/**
 * 遍历目录获取子文件
 *
 * @param string $dir 遍历目标目录路径
 *
 * @return array
 */
function list_files($dir)
{
    $files = array();

    if (is_dir($dir)) {

        if ($handler = opendir($dir)) {

            while (($file = readdir($handler)) !== false) {

                $path = $dir . "/" . $file;

                if ((is_file($path)) && $file != "." && $file != "..") {

                    array_push($files, $path);
                }
            }
            closedir($handler);
        }
    }

    return $files;
}


/**
 * 遍历目录获取子目录
 *
 * @param string $dir 遍历目标目录路径
 *
 * @return array
 */
function list_dirs($dir)
{
    $dirs = array();

    if (is_dir($dir)) {

        if ($handler = opendir($dir)) {

            while (($file = readdir($handler)) !== false) {

                $path = $dir . "/" . $file;

                if ((is_dir($path)) && $file != "." && $file != "..") {

                    array_push($dirs, $path);

                }
            }
            closedir($handler);
        }
    }

    return $dirs;
}

/**
 * 获取数组最大维度
 *
 * @param $array
 *
 * @return int
 */
function array_depth($array)
{
    if (!is_array($array)) return 0;
    $max_depth = 1;
    foreach ($array as $value) {
        if (is_array($value)) {
            $depth = array_depth($value) + 1;

            if ($depth > $max_depth) {
                $max_depth = $depth;
            }
        }
    }
    return $max_depth;
}

