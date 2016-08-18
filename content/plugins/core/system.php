<?php

/**
 * 获取系统设置数据接受字段
 *
 * @return array
 */
function get_system_config_fields()
{

    $system_config_fields = ['id', 'system_configname', 'email', 'phone', 'password', 'nickname', 'avatar', 'source', 'status', 'created_at', 'updated_at'];

    return $system_config_fields;
}

/**
 * 初始化系统设置数据
 *
 * @param array $data
 *
 */
function initialize_system_config(array &$data)
{

    $initialize = [
        'id' => id(),
        'avatar' => '/content/web/src/images/avatar.png',
        'source' => 'backend',
        'status' => 'normal',
    ];

    $data = array_merge($initialize, $data);

}

/**
 * 验证系统设置数据
 *
 * @param array $data 验证数据
 * @param bool $insert 是否为新插入
 *
 * @return mixed
 */
function validate_system_config(array $data, $insert = false)
{
    initialize_system_config($data);

    $rule = [
        'id' => 'sometimes|unique:system_config',
        'system_configname' => 'required|unique:system_config',
        'password' => 'required',
        'email' => 'sometimes|unique:system_config',
        'phone' => 'sometimes|unique:system_config',

    ];

    $message = [
        'name.required' => '系统设置名称不能为空',
        'name.unique' => '系统设置名称已被使用',
    ];


    return validate($data, $rule, $message);
}


/**
 * 获取系统设置
 *
 * @param string $system_config_id
 *
 * @return mixed
 */
function the_system_config($system_config_id)
{

    return table('system_config')->where('id', $system_config_id)->first();
}


/**
 * 删除系统设置
 *
 * @param string $system_config_id
 *
 * @return mixed
 */
function delete_system_config($system_config_id)
{
    return table('system_config')->where('id', $system_config_id)->delete();
}


/**
 * 获取系统设置组
 *
 * @param array $params
 *
 * @return mixed
 */
function get_system_config(array $params)
{
    return selector('system_config', $params);
}


/**
 * 添加系统设置
 *
 * @param array $data
 *
 * @return mixed
 */
function add_system_config(array $data)
{

    return transaction(function () use ($data) {

        filter_fields($data, get_system_config_fields());

        table('system_config')->insert($data);

        $system_config = the_system_config($data['id']);

        return $system_config;

    });

}

/**
 * 更新系统设置
 *
 * @param $system_config_id
 * @param array $data
 * @return mixed
 *
 * @throws Exception
 */
function update_system_config($system_config_id, array $data)
{
    return transaction(function () use ($system_config_id, $data) {

        $data['updated_at'] = timestamp();

        filter_fields($data, get_system_config_fields(), ['id']);

        table('system_config')->where('id', $system_config_id)->update($data);

        $system_config = the_system_config($system_config_id);

        return $system_config;

    });
}




