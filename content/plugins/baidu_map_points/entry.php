<?php

add_action('load_side_menus', function () {

    load_side_menu(
        [
            'name' => '百度地图插件',
            'icon' => 'icon file',
            'link' => 'javascript:;'
        ],
        [
            [
                'name' => '顾客分布',
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


global $app;

use \Core\Services\Context;

$app->post('/order', function (Context $context) {

    $fields = ['id', 'name', 'address', 'phone', 'price', 'discount', 'freight', 'lng', 'lat', 'added_on', 'created_at', 'updated_at'];

    $data = $context->data();

    $rule = [
        'address' => 'required',
        'freight' => 'required',
        'added_on' => 'required',
    ];

    $message = [
        'address.required' => '送餐地址不能为空',
        'freight.required' => '运费不能为空',
        'added_on.required' => '发布日期不能为空',
    ];

    $check = validate($data, $rule, $message);

    if ($check !== true) {

        exception('ValidateFailed', $check);
    }

    filter_fields($data, $fields);

    $data['created_at'] = timestamp();

    if ($id = connection('bmp_mysql')->table('orders')->insertGetId($data)) {

    }

    return $context->status('success', connection('bmp_mysql')->table('orders')->where('id', $id)->first());

});

// /api/baidu_map_points/users

$app->get('/users', function (Context $context) {

    return $context->status('success',selector('user'));

});
