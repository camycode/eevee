<?php

global $app;


$app->get('/', function () use ($app) {
    return view('welcome');
});