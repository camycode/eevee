<?php


$permissions = [

    'POST' => [
        'resource','resource_permission','resource_fileds'
    ]

];

return array(

    'TERM' => [
        'permission' => 'AGUD',
        'fields' => [
            'id' => 'AGUD',
            'app_id' => 'AGUD',
            'parent' => 'AGUD',
            'name' => 'AGUD',
            'description' => 'AGUD',
            'cover' => 'AGUD',
        ],
    ],
    'POST' => [
        'permission' => 'AGUD',
        'fields' => [
            'id' => 'AGUD',
            'app_id' => 'AGUD',
            'user_id' => 'AGUD',
            'term_id' => 'AGUD',  // 不同的角色编辑不同的分类
            'title' => 'AGUD',
            'content' => 'AGUD',
            'type' => 'AGUD', // 不同的角色编辑不同的类型
            'status' => 'AGUD:public|private|forbidden|deleted', // 不同的角色编辑不同的状态
            'created_at' => 'AGUD',
            'updated_at' => 'AGUD',
        ],
        'dependencies'=>[
        ],
    ],
    'POST_TERM' => [
        '1' => 'G', '2' => 'G', '3' => 'G',
    ],

);