<?php
return [
    'titles' => [
        'permissions' => 'User Permissions',
        'permission_create' => 'Create permission',
        'permission_delete' => 'Delete permission',
        'permission_edit' => 'Edit permission',
        'roles' => 'User Roles',
        'role_create' => 'Create role',
        'role_show' => 'View role',
        'role_edit' => 'Edit role',
        'role_delete' => 'Delete role',
    ],
    'tables' => [
        'id' => 'ID',
        'permission' => 'Permission',
        'role' => 'Role',
        'name' => 'Name',
        'description' => 'Description',
        'actions' => 'Actions',
        'dates' => 'Createt/updated at',
        'relation_name' => 'Relation name',
        'relations_count' => 'Relations count',
        'roles' => 'Roles',
        'permissions' => 'Permissions',
        'users' => 'Users',
        'admins' => 'Admins',
    ],
    'labels' => [
        'name' => 'Alias',
        'display_name' => 'Name',
        'description' => 'Description',
    ],
    'texts' => [
        'permission_relations' => 'Current permission has relations. In case deleting you\'ll lose all those relations. If permission was hard-coded, it might call out some mistakes',
        'role_relations' => 'Current role has relations. In case deleting you\'ll lose all those relations. If role was hard-coded, it might call out some mistakes',
    ],
    'buttons' => [
        'role_back' => 'Back to the list of roles',
    ],
];
