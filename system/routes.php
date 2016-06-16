<?php


$app->get('/', function () use ($app) {
    return view('welcome');
});


$app->group(['middleware' => 'auth', 'namespace' => 'Core\Controllers'], function ($app) {

    $app->get('/api/user', 'UserController@getUser');
    $app->get('/api/users', 'UserController@getUsers');
    $app->post('/api/user', 'UserController@postUser');

    $app->post('/api/auth/login', 'AuthController@login');


});
