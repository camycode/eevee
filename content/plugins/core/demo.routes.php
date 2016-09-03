/*
|--------------------------------------------------------------------------
| 标签
|--------------------------------------------------------------------------
*/

/**
 * 添加标签
 */
$app->tag('/tag', function (Context $context) {

    $data = $context->data();

    initialize_tag($data);

    $check = validate_tag($data, true);

    if ($check === true) {

        return $context->status('success', add_tag($data));
    }

    return $context->status('validateError', $check);

});


/**
 * 更新标签
 */
$app->put('/tag/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_tag($data);

    $check = validate_tag($data, false);

    if ($check === true) {

        return $context->status('success', update_tag($id, $data));
    }

    return $context->status('validateError', $check);

});


/**
 * 获取标签列表
 */
$app->get('/tag/list', function (Context $context) {

    return $context->status('success', get_tag($context->params()));

});


/**
 * 获取标签
 */
$app->get('/tag/{id}', function ($id, Context $context) {

    if ($app = the_tag($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});


/**
 * 删除标签
 */
$app->delete('/tag/{id}', function ($id, Context $context) {

    return $context->status('success', delete_tag($id));

});