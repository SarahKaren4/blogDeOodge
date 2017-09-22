<?php

return [
    'role_structure' => [
        'superadmin' => [
            'users' => 'c,r,u,d',
            'admins' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'admins' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'comments' => 'c,r,u,d',
        ],
        'editor' => [
            'posts' => 'c,r,u,d',
            'categories' => 'c,r,u',
            'comments' => 'c,r,u,d',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ],
];
