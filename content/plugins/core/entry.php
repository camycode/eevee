<?php

use Core\Services\Context;
use Illuminate\Support\Facades\DB;

global $app;


$app->get('/', function (Context $context) {

    echo 'Hello Core';
});


$app->get('/hello', function (Context $context) {

    return $context->status('success', DB::table('app')->get());

});
