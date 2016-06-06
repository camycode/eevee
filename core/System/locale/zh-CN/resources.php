<?php
/**
 * 资源信息.
 *
 * 以此配置后台的管理界面和角色的权限分配列表.
 *
 * @author 古月
 */

return [
    'APP' => [
        'name' => '应用',
        'description' => '项目应用',
        'fields' => [
            'id' => 'ID',
            'name' => '名称',
            'description' => '描述',
        ],
        'icon' => '',
        'actions' => [
            'add' => [
                'name' => '添加应用',
            ],
            'update' => [
                'name' => '编辑应用',
            ],
            'get' => [
                'name' => '获取应用',
            ],
            'delete' => [
                'name' => '删除应用',
            ],
        ],
        'statuses' => [
            'public' => '公开',
            'private' => '私有',
            'forbidden' => '禁用',
            'deleted' => '删除',
        ],
    ],

    'RESOURCE' => [
        'name' => '应用资源',
        'description' => '定义应用资源',
        'icon' => '',
        'actions' => [
            'add' => [
                'name' => '添加应用资源',
            ],
            'update' => [
                'name' => '编辑应用资源',
            ],
            'get' => [
                'name' => '获取应用资源',
            ],
            'delete' => [
                'name' => '删除应用资源',
            ],
        ],
    ],

    'PERMISSION' => [
        'name' => '应用权限',
        'description' => '定义应用权限',
        'icon' => '',
        'actions' => [
            'add' => [
                'name' => '添加应用权限',
            ],
            'update' => [
                'name' => '编辑应用权限',
            ],
            'get' => [
                'name' => '获取应用权限',
            ],
            'delete' => [
                'name' => '删除应用权限',
            ],
        ],
    ],

    'ROLE' => [
        'name' => '角色',
        'description' => '描述',
        'icon' => '',
        'actions' => [
            'add' => [
                'name' => '添加角色',
            ],
            'update' => [
                'name' => '编辑角色',
            ],
            'get' => [
                'name' => '获取角色',
            ],
            'delete' => [
                'name' => '删除角色',
            ],
        ],
        'types' => [],
        'statuses' => [
            'public' => '公开',
            'private' => '私有',
            'forbidden' => '禁用',
            'deleted' => '删除',
        ],
    ],
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
        'statuses' => [
            'public' => '公开',
            'private' => '私有',
            'forbidden' => '禁用',
            'deleted' => '删除',
        ],
    ],
    'POST' => [
        'name' => '文章',
        'description' => '描述',
        'icon' => '',
        'actions' => [
            'add' => [
                'name' => '添加文章',
            ],
            'update' => [
                'name' => '编辑文章',
            ],
            'get' => [
                'name' => '获取文章',
            ],
            'delete' => [
                'name' => '删除文章',
            ],
        ],
        'statuses' => [
            'public' => '公开',
            'private' => '私有',
            'forbidden' => '禁用',
            'deleted' => '删除',
        ],
    ],
];
