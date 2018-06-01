<?php

return [
    'home' => [
        'handler' => 'App\Controllers\ProductController@vip',
        'path' => '/'
    ],
    'index' => [
        'handler' => 'App\Controllers\ProductController@index',
        'path' => '/products'
    ],
    'categories_list' => [
        'handler' => 'App\Controllers\CategoriesController@show',
        'path' => '/categories-list'
    ],
    'city_list' => [
        'handler' => 'App\Controllers\CityController@show',
        'path' => '/city-list'
    ],
    'product_show' => [
        'handler' => 'App\Controllers\ProductController@show',
        'path' => '/product/{id}',
        'method' => 'GET'
    ],
    'product_create' => [
        'handler' => 'App\Controllers\ProductController@create',
        'path' => '/product',
        'method' => 'POST',
        /* 'acl' => ['user', 'admin'] */
    ],
    'product_update' => [
        'handler' => 'App\Controllers\ProductController@create',
        'path' => '/product',
        'method' => 'PUT',
        'acl' => ['user', 'admin']
    ],
    'product_delete' => [
        'handler' => 'App\Controllers\ProductController@create',
        'path' => '/product',
        'method' => 'DELETE',
        'acl' => ['user', 'admin']
    ],
    'login' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@login',
        'path' => '/login',
        'method' => 'POST',
    ],
    'register' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@register',
        'path' => '/register',
        'method' => 'POST',
    ],
    'logout' => [
        'handler' => 'Mindk\Framework\Controllers\UserController@logout',
        'path' => '/logout',
        'method' => 'POST',
    ]
];