<?php

/**
 * 获取文件夹数据接受字段
 *
 * @return array
 */
function get_folder_fields()
{

    $folder_fields = ['id', 'foldername', 'email', 'phone', 'password', 'nickname', 'avatar', 'source', 'status', 'created_at', 'updated_at'];

    return $folder_fields;
}

/**
 * 初始化文件夹数据
 *
 * @param array $data
 *
 */
function initialize_folder(array &$data)
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
 * 验证文件夹数据
 *
 * @param array $data 验证数据
 * @param bool $insert 是否为新插入
 *
 * @return mixed
 */
function validate_folder(array $data, $insert = false)
{
    initialize_folder($data);

    $rule = [
        'id' => 'sometimes|unique:folder',
        'foldername' => 'required|unique:folder',
        'password' => 'required',
        'email' => 'sometimes|unique:folder',
        'phone' => 'sometimes|unique:folder',

    ];

    $message = [
        'name.required' => '文件夹名称不能为空',
        'name.unique' => '文件夹名称已被使用',
    ];


    return validate($data, $rule, $message);
}


/**
 * 获取文件夹
 *
 * @param string $folder_id
 *
 * @return mixed
 */
function the_folder($folder_id)
{

    return table('folder')->where('id', $folder_id)->first();
}


/**
 * 删除文件夹
 *
 * @param string $folder_id
 *
 * @return mixed
 */
function delete_folder($folder_id)
{
    return table('folder')->where('id', $folder_id)->delete();
}


/**
 * 获取文件夹组
 *
 * @param array $params
 *
 * @return mixed
 */
function get_folder(array $params)
{
    return selector('folder', $params);
}


/**
 * 添加文件夹
 *
 * @param array $data
 *
 * @return mixed
 */
function add_folder(array $data)
{

    return transaction(function () use ($data) {

        filter_fields($data, get_folder_fields());

        table('folder')->insert($data);

        $folder = the_folder($data['id']);

        return $folder;

    });

}

/**
 * 更新文件夹
 *
 * @param $folder_id
 * @param array $data
 * @return mixed
 *
 * @throws Exception
 */
function update_folder($folder_id, array $data)
{
    return transaction(function () use ($folder_id, $data) {

        $data['updated_at'] = timestamp();

        filter_fields($data, get_folder_fields(), ['id']);

        table('folder')->where('id', $folder_id)->update($data);

        $folder = the_folder($folder_id);

        return $folder;

    });
}




