<?php

/**
 * 获取文件数据接受字段
 *
 * @return array
 */
function get_file_fields()
{

    $file_fields = ['id', 'filename', 'email', 'phone', 'password', 'nickname', 'avatar', 'source', 'status', 'created_at', 'updated_at'];

    return $file_fields;
}

/**
 * 初始化文件数据
 *
 * @param array $data
 *
 */
function initialize_file(array &$data)
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
 * 验证文件数据
 *
 * @param array $data 验证数据
 * @param bool $insert 是否为新插入
 *
 * @return mixed
 */
function validate_file(array $data, $insert = false)
{
    initialize_file($data);

    $rule = [
        'id' => 'sometimes|unique:file',
        'filename' => 'required|unique:file',
        'password' => 'required',
        'email' => 'sometimes|unique:file',
        'phone' => 'sometimes|unique:file',

    ];

    $message = [
        'name.required' => '文件名称不能为空',
        'name.unique' => '文件名称已被使用',
    ];


    return validate($data, $rule, $message);
}


/**
 * 获取文件
 *
 * @param string $file_id
 *
 * @return mixed
 */
function the_file($file_id)
{

    return table('file')->where('id', $file_id)->first();
}


/**
 * 删除文件
 *
 * @param string $file_id
 *
 * @return mixed
 */
function delete_file($file_id)
{
    return table('file')->where('id', $file_id)->delete();
}


/**
 * 获取文件组
 *
 * @param array $params
 *
 * @return mixed
 */
function get_file(array $params)
{
    return selector('file', $params);
}


/**
 * 添加文件
 *
 * @param array $data
 *
 * @return mixed
 */
function add_file(array $data)
{

    return transaction(function () use ($data) {

        filter_fields($data, get_file_fields());

        table('file')->insert($data);

        $file = the_file($data['id']);

        return $file;

    });

}

/**
 * 更新文件
 *
 * @param $file_id
 * @param array $data
 * @return mixed
 *
 * @throws Exception
 */
function update_file($file_id, array $data)
{
    return transaction(function () use ($file_id, $data) {

        $data['updated_at'] = timestamp();

        filter_fields($data, get_file_fields(), ['id']);

        table('file')->where('id', $file_id)->update($data);

        $file = the_file($file_id);

        return $file;

    });
}




