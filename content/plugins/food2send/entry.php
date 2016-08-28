<?php

global $app;


add_action('load_side_menus', function () {

    load_side_menu(
        [
            'name' => '外卖配送平台管理',
            'icon' => 'icon folder',
            'link' => 'http://baidu.com'
        ],
        [
            [
                'name' => '外卖统计',
                'link' => ''
            ],
            [
                'name' => '设置',
                'link' => ''
            ]
        ]);
});


$app->get('/', function (\Core\Services\Context $context) {


    return $context->status('success', selector('user', $context->params()));

});