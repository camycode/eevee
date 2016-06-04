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

    // 应用客户端
    'get@app/client' => ['action' => 'App\ClientController@getClient', 'permission' => []],
    'get@app/clients' => ['action' => 'App\ClientController@getClients', 'permission' => []],
    'post@app/client' => ['action' => 'App\ClientController@postClient', 'permission' => []],
    'put@app/client' => ['action' => 'App\ClientController@putClient', 'permission' => []],
    'delete@app/client' => ['action' => 'App\ClientController@deleteClient', 'permission' => []],

    // 应用客户端版本
    'get@app/client/version' => ['action' => 'App\Client\VersionController@getVersion', 'permission' => []],
    'get@app/client/versions' => ['action' => 'App\Client\VersionController@getVersions', 'permission' => []],
    'post@app/client/version' => ['action' => 'App\Client\VersionController@postVersion', 'permission' => []],
    'put@app/client/version' => ['action' => 'App\Client\VersionController@putVersion', 'permission' => []],
    'delete@app/client/version' => ['action' => 'App\Client\VersionController@deleteVersion', 'permission' => []],

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
    'get@system/user/menu' => ['action' => 'SystemController@getUserMenu'],
    'get@system/refresh' => ['action' => 'SystemController@refresh'],
    'get@asset' => ['action' => 'SystemController@asset'],

    // 系统资源
    'get@system/resource' => ['action' => 'ResourceController@getResource', 'permission' => []],
    'get@system/resources' => ['action' => 'ResourceController@getResources', 'permission' => []],
    'post@system/resource' => ['action' => 'ResourceController@postResource', 'permission' => []],
    'put@system/resource' => ['action' => 'ResourceController@putResource', 'permission' => []],
    'delete@system/resource' => ['action' => 'ResourceController@deleteResource', 'permission' => []],


];