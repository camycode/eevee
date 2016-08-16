<?php


$app->get('/', function () use ($app) {
    return view('welcome');
});


$app->group(['middleware' => ['access', 'auth'], 'namespace' => 'Core\Controllers'], function ($app) {

    $app->get('/api/user', 'UserController@getUser');
    $app->get('/api/users', 'UserController@getUsers');
    $app->post('/api/user', 'UserController@postUser');

    // 用户登录
    $app->post('/api/auth/login', 'AuthController@login');

    // 获取个人信息
    $app->get('/api/auth/profile', 'AuthController@profile');


});
