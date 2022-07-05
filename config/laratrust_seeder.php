<?php

return [
    'create_users' => false,
    'truncate_tables' => true,
    'roles_structure' => [
        'super_admin' => [
            'roles' => 'c,r,u,d',
            'admins' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'product_categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'tags' => 'c,r,u,d',
            'reviews' => 'c,r,u,d',
            'coupons' => 'c,r,u,d',
        ],
        'admin' => [],
        'user' => [],

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
