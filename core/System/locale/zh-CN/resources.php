<?php
/**
 * 资源信息.
 *
 * 以此配置后台的管理界面和角色的权限分配列表.
 *
 * @author 古月
 */

return [
    'USER' => [
        'name' => '用户',
        'description' => '描述',
        'icon' => '',
        'actions' => [
            'add' => [
                'name' => '添加用户',
            ],
            'update' => [
                'name' => '编辑用户',
            ],
            'get' => [
                'name' => '获取用户',
            ],
            'delete' => [
                'name' => '删除用户',
            ],
        ],
    ],
//    'DASHBOARD' => '面板',
//    'ROLE' => '角色',
//    'PERMISSION' => '权限',
//    'TERM' => '分类',
//    'POST' => '内容',
//    'FILE' => '文件',
//    'FOLDER' => '文件夹',
//    'MESSAGE' => '沟通',
//    'SYSTEM' => '系统',
//    'MEDIA' => '多媒体',
//    'THEME' => '主题',
//    'PLUGIN' => '插件',
//    'HELP' => '帮助',
];
