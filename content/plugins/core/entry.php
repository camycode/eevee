<?php

global $app;

use Core\Services\Context;

include 'app.php';


$app->get('/', function (Context $context) {

    function hello()
    {

        echo id();
    }

    hello();


});


/**
 * 添加应用
 */
$app->get('/app/{id}', function ($id, Context $context) {

    if ($app = the_app($id)) {

        return $context->status('success', $app);

    } else {

        return $context->status('appDoesNotExist');
    }


});

/**
 * 添加应用
 */
$app->post('/app', function (Context $context) {

    $data = $context->data();

    initialize_app($data);

    $check = validate_app($data, true);

    if ($check === true) {

        return $context->status('success', add_app($data));
    }

    return $context->status('validateError', $check);

});


/**
 * 更新应用
 */
$app->put('/app/{id}', function ($id, Context $context) {


    $data = $context->data();

    initialize_app($data);

    $check = validate_app($data, false);

    if ($check === true) {

        return $context->status('success', update_app($id, $data));
    }

    return $context->status('validateError', $check);

});


