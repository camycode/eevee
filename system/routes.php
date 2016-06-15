<?php


$app->group(['namespace' => 'Core\Controllers'], function ($app) {

    $app->get('/', function () use ($app) {
        return 'Hello EEVEE!';
    });

});


//return [
//
//    // 认证模块
//    'post@auth/login'       => ['action' => 'AuthController@login'],
//    'post@auth/register'    => ['action' => 'AuthController@register'],
//
//    // 应用模块
//    'post@app'   => ['action' => 'AppController@postApp'],
//    'put@app'    => ['action' => 'AppController@putApp'],
//    'get@app'    => ['action' => 'AppController@getApp'],
//    'get@apps'   => ['action' => 'AppController@getApps'],
//    'delete@app' => ['action' => 'AppController@deleteApp'],
//
//
//    // 用户模块
//    'post@user'   => ['action' => 'UserController@postUser',    ],
//    'get@users'   => ['action' => 'UserController@getUsers',    ],
//    'get@user'    => ['action' => 'UserController@getUser',     ],
//    'put@user'    => ['action' => 'UserController@putUser',     ],
//    'delete@user' => ['action' => 'UserController@deleteUser',  ],
//
//    // 角色模块
//    'post@role'             => ['action' => 'RoleController@postRole',       ß],
//    'put@role'              => ['action' => 'RoleController@putRole',        ß],
//    'delete@role'           => ['action' => 'RoleController@deleteRole',     ß],
//    'get@roles'             => ['action' => 'RoleController@getRoles',       ß],
//    'get@role'              => ['action' => 'RoleController@getRole',        ß],
//    'get@role/permissions'  => ['action' => 'RoleController@getPermissions', ß],
//
//    // 系统模块
//    'get@version'           => ['action' => 'SystemController@version'],
//    'post@system/install'   => ['action' => 'SystemController@install'],
//    'get@asset'             => ['action' => 'SystemController@asset'],
//    'post@system/config'    => ['action' => 'SystemController@postConfig',      ],
//    'put@system/config'     => ['action' => 'SystemController@putConfig',       ],
//    'get@system/config'     => ['action' => 'SystemController@getConfig',       ],
//    'delete@system/config'  => ['action' => 'SystemController@deleteConfig',    ],
//    'get@system/user/menu'  => ['action' => 'SystemController@getUserMenu'],
//
//    // 插件模块
//    'get@local/plugins' => ['action' => 'PluginController@getLocalPlugins', ],
//
//    // 用户设置
//    'post@config'       => ['action' => 'ConfigController@postConfig'],
//    'put@config'        => ['action' => 'ConfigController@putConfig'],
//    'post@config/save'  => ['action' => 'ConfigController@saveConfig'],
//    'get@config'        => ['action' => 'ConfigController@getConfig'],
//    'delete@config'     => ['action' => 'ConfigController@deleteConfig'],
//
//    // 分类管理
//    'post@term'     => ['action' => 'TermController@postTerm'],
//    'put@term'      => ['action' => 'TermController@putTerm'],
//    'get@term'      => ['action' => 'TermController@getTerm'],
//    'delete@term'   => ['action' => 'TermController@deleteTerm'],
//
//    // 文章模块
//    'post@post' => ['action' => 'PostController@postPost'],
//    'get@post'  => ['action' => 'PostController@getPost'],
//    'get@posts' => ['action' => 'PostController@getPosts'],
//
//    // 用户消息
//    'post@message'  => ['action' => 'MessageController@postMessage'],
//    'get@message'   => ['action' => 'MessageController@getMessage'],
//];
