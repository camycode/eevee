<?php

use Core\Services\Http;
use Core\Services\Context;
use Illuminate\Support\Facades\DB;

global $app;

$app->get('/', function (Context $context) {

   $content = Http::request('/api/core/hello','GET');

//    print_r($content);


//    echo 'Hello';
//    return $context->response(status('success', DB::table('app')->get()));

//    echo 'Hello Core';
});

$app->get('/hello', function (Context $context) {

    return $context->status('success', DB::table('app')->get());

});



add_action('load_plugin_styles', function () {

//    echo 'Hello world';

});