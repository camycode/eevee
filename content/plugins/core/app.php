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
 * 删除应用
 *
 * @param string $app_id
 *
 * @return mixed
 */
function delete_app($app_id)
{
    return table('app')->where('id', $app_id)->delete();
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

        $data['created_at'] = timestamp();

        $data['updated_at'] = timestamp();

        filter_fields($data, get_app_fields());

        table('app')->insert($data);

        $app = the_app($data['id']);

        return $app;

    });

}

function update_app($id, array $data)
{
    return transaction(function () use ($id, $data) {

        $data['updated_at'] = timestamp();

        filter_fields($data, get_app_fields(), ['id']);

        table('app')->where('id', $id)->update($data);

        $app = the_app($id);

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


