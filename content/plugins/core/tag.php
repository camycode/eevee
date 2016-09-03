<?php

/**
 * 获取标签数据接受字段
 *
 * @return array
 */
function get_tag_fields()
{

    $tag_fields = ['id', 'tagname', 'email', 'phone', 'password', 'nickname', 'avatar', 'source', 'status', 'created_at', 'updated_at'];

    return $tag_fields;
}

/**
 * 初始化标签数据
 *
 * @param array $data
 *
 */
function initialize_tag(array &$data)
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
 * 验证标签数据
 *
 * @param array $data 验证数据
 * @param bool $insert 是否为新插入
 *
 * @return mixed
 */
function validate_tag(array $data, $insert = false)
{
    initialize_tag($data);

    $rule = [
        'id' => 'sometimes|unique:tag',
        'tagname' => 'required|unique:tag',
        'password' => 'required',
        'email' => 'sometimes|unique:tag',
        'phone' => 'sometimes|unique:tag',

    ];

    $message = [
        'name.required' => '标签名称不能为空',
        'name.unique' => '标签名称已被使用',
    ];


    return validate($data, $rule, $message);
}


/**
 * 获取标签
 *
 * @param string $tag_id
 *
 * @return mixed
 */
function the_tag($tag_id)
{

    return table('tag')->where('id', $tag_id)->first();
}


/**
 * 删除标签
 *
 * @param string $tag_id
 *
 * @return mixed
 */
function delete_tag($tag_id)
{
    return table('tag')->where('id', $tag_id)->delete();
}


/**
 * 获取标签组
 *
 * @param array $params
 *
 * @return mixed
 */
function get_tag(array $params)
{
    return selector('tag', $params);
}


/**
 * 添加标签
 *
 * @param array $data
 *
 * @return mixed
 */
function add_tag(array $data)
{

    return transaction(function () use ($data) {

        filter_fields($data, get_tag_fields());

        table('tag')->insert($data);

        $tag = the_tag($data['id']);

        return $tag;

    });

}

/**
 * 更新标签
 *
 * @param $tag_id
 * @param array $data
 * @return mixed
 *
 * @throws Exception
 */
function update_tag($tag_id, array $data)
{
    return transaction(function () use ($tag_id, $data) {

        $data['updated_at'] = timestamp();

        filter_fields($data, get_tag_fields(), ['id']);

        table('tag')->where('id', $tag_id)->update($data);

        $tag = the_tag($tag_id);

        return $tag;

    });
}




