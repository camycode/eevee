<?php

add_action('load_side_menus', function () {

    load_side_menu(
        [
            'name' => '百度地图定位插件',
            'icon' => 'icon file',
            'link' => 'javascript:;'
        ],
        [
            [
                'name' => '查看地图',
                'link' => '/backend/baidu_map_points?page=map'
            ],
            [
                'name' => '输入数据',
                'link' => '/backend/baidu_map_points?page=input'
            ],
            [
                'name' => '设置',
                'link' => '/backend/baidu_map_points?page=config'
            ]
        ]);
});


/**
 * 配置数据库连接
 */
set_connection('bmp_mysql', [
    'driver' => 'mysql',
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', 3306),
    'database' => 'ximuop',
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => 'xi_',
    'timezone' => env('DB_TIMEZONE', '+00:00'),
    'strict' => false,
]);

