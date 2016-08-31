<?php

add_action('load_side_menus', function () {

    load_side_menu(
        [
            'name' => '微信公众平台',
            'icon' => 'icon file',
            'link' => 'javascript:;'
        ],
        [
            [
                'name' => '用户统计',
                'link' => ''
            ],
            [
                'name' => '设置',
                'link' => ''
            ]
        ]);
});


add_action('install_plugin', function ($installer) {

    
});