<?php

/**
 * 获取用户数据接受字段
 *
 * @return array
 */
function get_user_fields()
{

    $user_fields = ['id', 'name', 'description', 'status', 'created_at', 'updated_at'];

    return $user_fields;
}

/**
 * 初始化用户数据
 *
 * @param array $data
 *
 */
function initialize_user(array &$data)
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
 * 验证用户数据
 *
 * @param array $data 验证数据
 * @param bool $insert 是否为新插入
 *
 * @return mixed
 */
function validate_user(array $data, $insert = false)
{
    initialize_user($data);

    $rule = [
        'id' => 'sometimes|unique:user',
        'name' => 'required|unique:user',
    ];

    $message = [
        'name.required' => '用户名称不能为空',
        'name.unique' => '用户名称已被使用',
    ];


    return validate($data, $rule, $message);
}



/**
 * 过滤用户数据冗余字段
 *
 * @param array $data
 */
function filter_user_fields(array &$data)
{
    filter_fields($data, get_user_fields());
}


/**
 * 获取用户
 *
 * @param string $user_id
 *
 * @return mixed
 */
function the_user($user_id)
{

    return table('user')->where('id', $user_id)->first();
}

/**
 * 获取用户组
 *
 * @param array $params
 *
 * @return mixed
 */
function get_user(array $params)
{
    return selector('user', $params);
}


/**
 * 添加用户
 *
 * @param array $data
 *
 * @return mixed
 */
function add_user(array $data)
{

    return transaction(function () use ($data) {

        filter_user_fields($data);

        table('user')->insert($data);

        $user = the_user($data['id']);

        return $user;

    });

}



