<?php

use Core\Services\Context;
use Illuminate\Support\Facades\DB;

global $app;

$app->get('/', function (Context $context) {

    return $context->response(status('success', DB::table('app')->get()));

//    echo 'Hello Core';
});

$app->get('/hello', function () {
    echo 'Hello world';
});


add_action('load_plugin_styles', function () {

//    echo 'Hello world';

});