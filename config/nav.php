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

        ],
        [
            'icon' => 'fa-brands fa-product-hunt',
            'route' => 'dashboard.products.index',
            'title' => 'Products',
            'active' => 'dashboard.products.*',

        ],
        [
            'icon' => 'fa-solid fa-store',
            'route' => 'dashboard.stores.index',
            'title' => 'Stores',
            'active' => 'dashboard.stores.*',

        ],
        [
            'icon' => 'fa-solid fa-user',
            'route' => 'dashboard.profile.edit',
            'title' => 'Profile',
            'active' => 'dashboard.profile.*',

        ],

];
