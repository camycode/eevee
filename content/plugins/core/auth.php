<?php


/**
 * 加密用户密码
 *
 * @param $str
 *
 * @return string
 */
function encrypt_user_password($str)
{

    return sha1($str);
}


/**
 * 验证用户输入密码
 *
 * @param string $input 键入密码
 * @param string $password 存储密码
 *
 * @return bool
 */
function auth_user_password($input, $password)
{
    return encrypt_user_password($input) == $password;
}

/**
 * 获取用户秘钥
 *
 * @param $app_id
 * @param $app_version
 * @param $user_id
 *
 * @return mixed
 */
function the_user_token($app_id, $app_version, $user_id)
{
    return table('user_token')->where('app_id', $app_id)->where('app_version', $app_version)->where('user_id', $user_id)->first();
}

/**
 * 删除用户秘钥
 *
 * @param $app_id
 * @param $app_version
 * @param $user_id
 *
 * @return mixed
 */
function delete_user_token($app_id, $app_version, $user_id)
{
    return table('user_token')->where('app_id', $app_id)->where('app_version', $app_version)->where('user_id', $user_id)->first();
}

/**
 * 添加用户秘钥
 *
 * @param $app_id
 * @param $app_version
 * @param $user_id
 * @param $password
 *
 * @return mixed
 */
function add_user_token($app_id, $app_version, $user_id, $password)
{
    $data = [
        'app_id' => $app_id,
        'app_version' => $app_version,
        'user_id' => $user_id,
        'user_token' => sha1($app_id . $app_version . $user_id . $password),
        'created_at' => timestamp(),
        'updated_at' => timestamp(),
    ];

    if (table('user_token')->insert($data)) {

        return $data['user_token'];
    }

    return false;
}

/**
 * 更新用户秘钥
 *
 * @param $app_id
 * @param $app_version
 * @param $user_id
 * @param $password
 *
 * @return mixed
 */
function update_user_token($app_id, $app_version, $user_id, $password)
{
    $data = [
        'user_token' => sha1($app_id . $app_version . $user_id . $password),
        'updated_at' => timestamp(),
    ];

    if (table('user_token')->where('app_id', $app_id)->where('app_version', $app_version)->where('user_id', $user_id)->update($data)) {

        return $data['user_token'];
    }

    return false;

}


/**
 * 保存用户秘钥
 *
 * @param $app_id
 * @param $app_version
 * @param $user_id
 * @param $password
 *
 * @return mixed
 */
function save_user_token($app_id, $app_version, $user_id, $password)
{

    if (the_user_token($app_id, $app_version, $user_id)) {

        return update_user_token($app_id, $app_version, $user_id, $password);

    } else {

        return add_user_token($app_id, $app_version, $user_id, $password);

    }
}