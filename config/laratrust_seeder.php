<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'admins' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'admins' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
        ],
        'editor' => [
            'users' => 'r',
            'posts' => 'c,r,u,d',
            'categories' => 'r',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ],
];
