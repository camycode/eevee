<?php

return [
    'APP' => [
        'table' => 'apps',
        'fields' => ['id', 'name', 'description', 'created_at', 'updated_at'],
    ],
    'USER' => [
        'table' => 'users',
        'fields' => ['id', 'username', 'email', 'status', 'avatar', 'source', 'password', 'created_at', 'updated_at'],
    ],
    'ROLE' => [
        'table' => 'roles',
        'fields' => ['id', 'name', 'description', 'parent', 'source', 'status', 'created_at', 'updated_at'],
    ],
    'CONFIG' => [
        'table' => 'configs',
        'fields' => ['config_key', 'config_value', 'source'],
    ],
    'MESSAGE' => [
        'table' => 'messages',
        'fields' => [],
    ],
    'RESOURCE' => [
        'table' => 'resources',
        'fields' => [],
    ],
    'PERMISSION' => [
        'table' => 'permissions',
        'fields' => [],
    ],
    'USERTOKEN' => [
        'table' => 'user_tokens',
        'fields' => [],
    ],
    'L:TERMRELATIONSHIP' => [
        'table' => 'terms_relationships',
        'fields' => [],
    ],
    'L:ROLERELATIONSHIP' => [
        'table' => 'roles_relationships',
        'fields' => [],
    ],
    'L:PERMISSIONRELATIONSHIP' => [
        'table' => 'permissions_relationships',
        'fields' => [],
    ],
];
