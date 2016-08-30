<?php

global $app;

use Core\Services\Context;

/**
 * 后台登陆
 */
$app->get('/backend/login', function (Context $context) {

    if ($context->request->session()->has('access_user')) {

        return redirect('/backend/core');
    }

    include 'templates/login.template.php';

});

/**
 * 后台插件页面
 */
$app->get('/backend/{name}', function ($name, Context $context) {

    if (!$context->request->session()->has('access_user')) {

        return redirect('/backend/login');
    }

    ob_start();

    $view = base_path("content/plugins/$name/view.php");

    if (file_exists($view)) {

        include $view;
    }

    $be_content = ob_get_contents();

    ob_end_clean();

    $be_access_user = $context->request->session()->get('access_user');

    include 'templates/layout.template.php';

});

