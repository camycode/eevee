<?php

/**
 * 获取应用数据接受字段
 *
 * @return array
 */
function get_app_fields()
{

    $app_fields = ['id', 'name', 'description', 'status', 'created_at', 'updated_at'];

    return $app_fields;
}

/**
 * 初始化应用数据
 *
 * @param array $data
 *
 */
function initialize_app(array &$data)
{

    $initialize = [
        'id' => id(),
        'name' => '',
        'description' => '',
        'status' => 'public',
        'created_at' => timestamp(),
        'updated_at' => timestamp(),
    ];

    $data = array_merge($initialize, $data);

}

/**
 * 验证应用数据
 *
 * @param array $data 验证数据
 * @param bool $insert 是否为新插入
 *
 * @return mixed
 */
function validate_app(array $data, $insert = false)
{
    initialize_app($data);

    $rule = [
        'id' => 'sometimes|unique:app',
        'name' => 'required|unique:app',
    ];

    $message = [
        'name.required' => '应用名称不能为空',
        'name.unique' => '应用名称已被使用',
    ];


    return validate($data, $rule, $message);
}


function validate_app_version($data)
{

}

/**
 * 过滤应用数据冗余字段
 *
 * @param array $data
 */
function filter_app_fields(array &$data)
{
    filter_fields($data, get_app_fields());
}


/**
 * 获取应用
 *
 * @param string $app_id
 *
 * @return mixed
 */
function the_app($app_id)
{

    return table('app')->where('id', $app_id)->first();
}

/**
 * 获取应用组
 *
 * @param array $params
 *
 * @return mixed
 */
function get_app(array $params)
{
    return selector('app', $params);
}


/**
 * 添加应用
 *
 * @param array $data
 *
 * @return mixed
 */
function add_app(array $data)
{

    return transaction(function () use ($data) {

        filter_app_fields($data);

        table('app')->insert($data);

        $app = the_app($data['id']);

        return $app;

    });

}

/**
 * 添加应用版本
 *
 * @param array $data
 *
 * @return mixed
 */
function add_app_version(array $data)
{
    return table('app_version')->insert($data);
}


