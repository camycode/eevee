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
    'post@auth/forgot' => ['action' => 'AuthController@forgot'],
    'post@auth/reset' => ['action' => 'AuthController@reset'],

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

    // 系统版本
    'get@version' => ['action' => 'SystemController@version'],

    // 系统安装
    'post@system/install' => ['action' => 'SystemController@install'],

    // 系统用户菜单
    'get@system/user/menu' => ['action' => 'SystemController@getUserMenu'],

    // 系统刷新
    'get@system/refresh' => ['action' => 'SystemController@refresh'],

    // 获取系统静态文件
    'get@asset' => ['action' => 'SystemController@asset'],

    // 系统资源
    'get@system/resource' => ['action' => 'ResourceController@getResource', 'permission' => []],
    'get@system/resources' => ['action' => 'ResourceController@getResources', 'permission' => []],

    // 系统资源
    'get@system/permission' => ['action' => 'ResourceController@getResource', 'permission' => []],
    'get@system/permissions' => ['action' => 'ResourceController@getResources', 'permission' => []],

];