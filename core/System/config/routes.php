<?php

/**
 * 异常报警.
 *
 * 如果调用到相关权限时，未找到注册信息，则发送邮件，或短信，并在管理页面进行提示显示
 */

return [

    // 系统版本
    'get@version' => [
        'action' => 'SystemController@version',
    ],
    // 登录
    'post@login' => [
        'action' => 'AuthController@login',
    ],

    // 注册
    'post@register' => [
        'action' => 'AuthController@register',
    ],

    // 用户模块
    'post@user' => [
        'action' => 'UserController@post',
        'permission' => 'user.post',
        'type' => true,
        'field' => 'type',
    ],
    'get@users' => [
        'action' => 'UserController@getUsers',
        'permission' => 'user.get',
    ],
    'get@user' => [
        'action' => 'UserController@getUser',
        'permission' => 'user.get',
    ],

    // 角色模块
    'post@role' => [
        'action' => 'RoleController@postRole',
        'permission' => 'role.post',
    ],
    'get@roles' => [
        'action' => 'RoleController@getRoles',
        'permission' => 'role.get',
    ],
    'get@role' => [
        'action' => 'RoleController@getRole',
        'permission' => 'role.get',
    ],

    // 系统
    'post@system/install' => [
        'action' => 'SystemController@install',
        'permission' => 'root',
    ],
];
