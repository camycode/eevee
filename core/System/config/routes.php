<?php

/**
 * 异常报警.
 *
 * 如果调用到相关权限时，未找到注册信息，则发送邮件，或短信，并在管理页面进行提示显示
 */

return [

    // 认证模块
    'post@auth/login' => ['action' => 'AuthController@login'],
    'post@auth/register' => ['action' => 'AuthController@register'],

    // 应用模块
    'post@app' => ['action' => 'AppController@postApp'],
    'put@app' => ['action' => 'AppController@putApp'],
    'get@app' => ['action' => 'AppController@getApp'],
    'get@apps' => ['action' => 'AppController@getApps'],
    'delete@app' => ['action' => 'AppController@deleteApp'],


    // 用户模块
    'post@user' => ['action' => 'UserController@postUser', 'permission' => 'USER_POST'],
    'get@users' => ['action' => 'UserController@getUsers', 'permission' => 'USER_GET'],
    'get@user' => ['action' => 'UserController@getUser', 'permission' => 'USER_GET'],
    'put@user' => ['action' => 'UserController@putUser', 'permission' => 'USER_PUT'],
    'delete@user' => ['action' => 'UserController@deleteUser', 'permission' => 'USER_DELETE'],

    // 角色模块
    'post@role' => ['action' => 'RoleController@postRole', 'permission' => 'ROLE_POST'],
    'put@role' => ['action' => 'RoleController@putRole', 'permission' => 'ROLE_PUT'],
    'delete@role' => ['action' => 'RoleController@deleteRole', 'permission' => 'ROLE_DELETE'],
    'get@roles' => ['action' => 'RoleController@getRoles', 'permission' => ['ROLE_GET', 'ROLE_GET']],
    'get@role' => ['action' => 'RoleController@getRole', 'permission' => 'ROLE_GET'],
    'get@role/permissions' => ['action' => 'RoleController@getPermissions', 'permission' => 'ROLE_GET'],

    // 系统模块
    'get@version' => ['action' => 'SystemController@version'],
    'post@system/install' => ['action' => 'SystemController@install'],
    'get@asset' => ['action' => 'SystemController@asset'],
    'post@system/config' => ['action' => 'SystemController@postConfig', 'permission' => 'SYSTEM_CONFIG_POST'],
    'put@system/config' => ['action' => 'SystemController@putConfig', 'permission' => 'SYSTEM_CONFIG_PUT'],
    'get@system/config' => ['action' => 'SystemController@getConfig', 'permission' => 'SYSTEM_CONFIG_GET'],
    'delete@system/config' => ['action' => 'SystemController@deleteConfig', 'permission' => 'SYSTEM_CONFIG_DELETE'],
    'get@system/user/menu' => ['action' => 'SystemController@getUserMenu'],

    // 插件模块
    'get@local/plugins' => ['action' => 'PluginController@getLocalPlugins', 'permission' => 'USER_GET'],

    // 用户设置
    'post@config' => ['action' => 'ConfigController@postConfig'],
    'put@config' => ['action' => 'ConfigController@putConfig'],
    'post@config/save' => ['action' => 'ConfigController@saveConfig'],
    'get@config' => ['action' => 'ConfigController@getConfig'],
    'delete@config' => ['action' => 'ConfigController@deleteConfig'],

    // 分类管理
    'post@term' => ['action' => 'TermController@postTerm'],
    'put@term' => ['action' => 'TermController@putTerm'],
    'get@term' => ['action' => 'TermController@getTerm'],
    'delete@term' => ['action' => 'TermController@deleteTerm'],

    // 文章模块
    'post@post' => ['action' => 'PostController@postPost'],
    'get@post' => ['action' => 'PostController@getPost'],
    'get@posts' => ['action' => 'PostController@getPosts'],

    // 用户消息
    'post@message' => ['action' => 'MessageController@postMessage'],
    'get@message' => ['action' => 'MessageController@getMessage'],

    'get@file' => ['action' => 'File@getFile', 'permission' => []],
    'get@files' => ['action' => 'File@getFiles', 'permission' => []],
    'post@file' => ['action' => 'File@postFile', 'permission' => []],
    'put@file' => ['action' => 'File@putFile', 'permission' => []],
    'delete@file' => ['action' => 'File@deleteFile', 'permission' => []],

    'get@terms' => ['action' => 'Term@getTerms', 'permission' => []],

];