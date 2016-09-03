<?php

/**
 * 获取分类数据接受字段
 *
 * @return array
 */
function get_term_fields()
{

    $term_fields = ['id', 'termname', 'email', 'phone', 'password', 'nickname', 'avatar', 'source', 'status', 'created_at', 'updated_at'];

    return $term_fields;
}

/**
 * 初始化分类数据
 *
 * @param array $data
 *
 */
function initialize_term(array &$data)
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
 * 验证分类数据
 *
 * @param array $data 验证数据
 * @param bool $insert 是否为新插入
 *
 * @return mixed
 */
function validate_term(array $data, $insert = false)
{
    initialize_term($data);

    $rule = [
        'id' => 'sometimes|unique:term',
        'termname' => 'required|unique:term',
        'password' => 'required',
        'email' => 'sometimes|unique:term',
        'phone' => 'sometimes|unique:term',

    ];

    $message = [
        'name.required' => '分类名称不能为空',
        'name.unique' => '分类名称已被使用',
    ];


    return validate($data, $rule, $message);
}


/**
 * 获取分类
 *
 * @param string $term_id
 *
 * @return mixed
 */
function the_term($term_id)
{

    return table('term')->where('id', $term_id)->first();
}


/**
 * 删除分类
 *
 * @param string $term_id
 *
 * @return mixed
 */
function delete_term($term_id)
{
    return table('term')->where('id', $term_id)->delete();
}


/**
 * 获取分类组
 *
 * @param array $params
 *
 * @return mixed
 */
function get_term(array $params)
{
    return selector('term', $params);
}


/**
 * 添加分类
 *
 * @param array $data
 *
 * @return mixed
 */
function add_term(array $data)
{

    return transaction(function () use ($data) {

        filter_fields($data, get_term_fields());

        table('term')->insert($data);

        $term = the_term($data['id']);

        return $term;

    });

}

/**
 * 更新分类
 *
 * @param $term_id
 * @param array $data
 * @return mixed
 *
 * @throws Exception
 */
function update_term($term_id, array $data)
{
    return transaction(function () use ($term_id, $data) {

        $data['updated_at'] = timestamp();

        filter_fields($data, get_term_fields(), ['id']);

        table('term')->where('id', $term_id)->update($data);

        $term = the_term($term_id);

        return $term;

    });
}




