<?php


$app->group(['namespace' => 'Core\Controllers'], function ($app) {

    $app->get('/', function () use ($app) {
        return view('welcome');
    });

    $app->get('/api/user', 'UserController@getUser');
    $app->get('/api/users', 'UserController@getUsers');
    $app->post('/api/user', 'UserController@postUser');


});
