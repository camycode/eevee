<?php

global $app;

use Core\Services\Context;

/**
 * 用户登陆
 */
$app->get('/backend/login', function (Context $context) {

    if ($context->request->session()->has('access_user')) {

        return redirect('/backend/core');
    }

    include 'templates/login.template.php';

});

/**
 * 插件视图展示
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

/**
 * 插件安装
 */
$app->get('/backend/install/plugin/{plugin_name}', function ($plugin_name, Context $context) {


    $file = base_path('content/plugins/' . $plugin_name . '/installer.php');

    if (file_exists($file)) {

        $installer = require $file;

        if(is_callable($installer)){

            $status = $installer('uninstall',schema(),$context);

            return $status;
        }

    }

});


/**
 * 插件卸载
 */
$app->get('/backend/uninstall/plugin/{plugin_name}', function ($plugin_name, Context $context) {


    $file = base_path('content/plugins/' . $plugin_name . '/uninstaller.php');

    if (file_exists($file)) {

        $installer = require $file;

        if(is_callable($installer)){

            $status = $installer('uninstall',schema(),$context);

            return $status;
        }

    }

});

