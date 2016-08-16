<?php

global  $app;

$app->get('/',function (){
    echo 'Hello Core';
});

$app->get('/hello',function (){
    echo 'Hello world';
});


add_action('load_plugin_styles',function (){

//    echo 'Hello world';

});