<?php

/**
 * 获取图文数据接受字段
 *
 * @return array
 */
function get_post_fields()
{

    $post_fields = ['id', 'postname', 'email', 'phone', 'password', 'nickname', 'avatar', 'source', 'status', 'created_at', 'updated_at'];

    return $post_fields;
}

/**
 * 初始化图文数据
 *
 * @param array $data
 *
 */
function initialize_post(array &$data)
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
 * 验证图文数据
 *
 * @param array $data 验证数据
 * @param bool $insert 是否为新插入
 *
 * @return mixed
 */
function validate_post(array $data, $insert = false)
{
    initialize_post($data);

    $rule = [
        'id' => 'sometimes|unique:post',
        'postname' => 'required|unique:post',
        'password' => 'required',
        'email' => 'sometimes|unique:post',
        'phone' => 'sometimes|unique:post',

    ];

    $message = [
        'name.required' => '图文名称不能为空',
        'name.unique' => '图文名称已被使用',
    ];


    return validate($data, $rule, $message);
}


/**
 * 获取图文
 *
 * @param string $post_id
 *
 * @return mixed
 */
function the_post($post_id)
{

    return table('post')->where('id', $post_id)->first();
}


/**
 * 删除图文
 *
 * @param string $post_id
 *
 * @return mixed
 */
function delete_post($post_id)
{
    return table('post')->where('id', $post_id)->delete();
}


/**
 * 获取图文组
 *
 * @param array $params
 *
 * @return mixed
 */
function get_post(array $params)
{
    return selector('post', $params);
}


/**
 * 添加图文
 *
 * @param array $data
 *
 * @return mixed
 */
function add_post(array $data)
{

    return transaction(function () use ($data) {

        filter_fields($data, get_post_fields());

        table('post')->insert($data);

        $post = the_post($data['id']);

        return $post;

    });

}

/**
 * 更新图文
 *
 * @param $post_id
 * @param array $data
 * @return mixed
 *
 * @throws Exception
 */
function update_post($post_id, array $data)
{
    return transaction(function () use ($post_id, $data) {

        $data['updated_at'] = timestamp();

        filter_fields($data, get_post_fields(), ['id']);

        table('post')->where('id', $post_id)->update($data);

        $post = the_post($post_id);

        return $post;

    });
}




