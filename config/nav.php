<?php

return [
        [
            'icon' => 'fas fa-tachometer-alt',
            'route' => 'dashboard.dashboard',
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'badge'=>'new'
        ],
        [
            'icon' => 'fa-solid fa-calendar-day',
            'route' => 'dashboard.categories.index',
            'title' => 'Categories',
            'active' => 'dashboard.categories.*',
            'ability' => 'categories.view',

        ],
        [
            'icon' => 'fa-brands fa-product-hunt',
            'route' => 'dashboard.products.index',
            'title' => 'Products',
            'active' => 'dashboard.products.*',
            'ability' => 'products.view',

        ],
        [
            'icon' => 'fa-solid fa-store',
            'route' => 'dashboard.stores.index',
            'title' => 'Stores',
            'active' => 'dashboard.stores.*',
            'ability' => 'stores.view',
        ],
        // [
        //     'icon' => 'fa-solid fa-list-check ',
        //     'route' => 'dashboard.stores.index',
        //     'title' => 'Orders',
        //     // 'active' => 'dashboard.orders.*',
        //     'active' => 'dashboard.stores.*',
        //     'ability' => 'orders.view',
        // ],
        [
            'icon' => 'fa-solid fa-layer-group',
            'route' => 'dashboard.roles.index',
            'title' => 'Roles',
            'active' => 'dashboard.roles.*',
            'ability' => 'roles.view',
        ],
        [
            'icon' => 'fa-solid fa-users',
            'route' => 'dashboard.admins.index',
            'title' => 'Admins',
            'active' => 'dashboard.admins.*',
            'ability' => 'admins.view',
        ],
        [
            'icon' => 'fa-solid fa-user',
            'route' => 'dashboard.profile.edit',
            'title' => 'Profile',
            'active' => 'dashboard.profile.*',

        ],

];
