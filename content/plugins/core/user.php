<?php

/**
 * 获取用户数据接受字段
 *
 * @return array
 */
function get_user_fields()
{

    $user_fields = ['id', 'username', 'email', 'phone', 'password', 'nickname', 'avatar', 'source', 'status', 'created_at', 'updated_at'];

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
        'avatar' => '/content/web/src/images/avatar.png',
        'source' => 'backend',
        'status' => '正常',
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
        'username' => 'required|unique:user',
        'password' => 'required',
        'email' => 'sometimes|unique:user',
        'phone' => 'sometimes|unique:user',

    ];

    $message = [
        'name.required' => '用户名称不能为空',
        'name.unique' => '用户名称已被使用',
    ];


    return validate($data, $rule, $message);
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
 * 删除用户
 *
 * @param string $user_id
 *
 * @return mixed
 */
function delete_user($user_id)
{
    return table('user')->where('id', $user_id)->delete();
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

        $data['created_at'] = timestamp();

        $data['updated_at'] = timestamp();

        $data['password'] = encrypt_user_password($data['password']);

        filter_fields($data, get_user_fields());

        table('user')->insert($data);

        $user = the_user($data['id']);

        return $user;

    });

}

/**
 * 更新用户
 *
 * @param $user_id
 * @param array $data
 * @return mixed
 *
 * @throws Exception
 */
function update_user($user_id, array $data)
{
    return transaction(function () use ($user_id, $data) {

        $data['updated_at'] = timestamp();

        filter_fields($data, get_user_fields(), ['id', 'password']);

        table('user')->where('id', $user_id)->update($data);

        $user = the_user($user_id);

        return $user;

    });
}




