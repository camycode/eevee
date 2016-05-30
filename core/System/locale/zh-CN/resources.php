<?php
/**
 * 默认注册导出资源.
 *
 * 以此配置后台的管理界面和角色的权限分配列表
 *
 * 可运行 " php artisan parse:permissions " 自动生成绑定资源的权限信息
 *
 * @author 古月
 */

return [
    'USER' => [
        'name' => '用户',
        'description' => '描述',
        'icon' => '',
        'image' => '',
        'permissions' => ['USER_ADD', 'USER_UPDATE', 'USER_GET', 'USER_DELETE']
    ],
    'DASHBOARD' => '面板',
    'ROLE' => '角色',
    'PERMISSION' => '权限',
    'TERM' => '分类',
    'POST' => '内容',
    'FILE' => '文件',
    'FOLDER' => '文件夹',
    'MESSAGE' => '沟通',
    'SYSTEM' => '系统',
    'MEDIA' => '多媒体',
    'THEME' => '主题',
    'PLUGIN' => '插件',
    'HELP' => '帮助',
];
