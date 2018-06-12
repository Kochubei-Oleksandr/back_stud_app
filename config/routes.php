<?php

return [
    'vip_post' => [
        'handler' => 'App\Controllers\ProductController@vipShow',
        'path' => '/',
        'method' => 'GET'
    ],
    'categories_list' => [
        'handler' => 'App\Controllers\CategoriesController@show',
        'path' => '/categories-list',
        'method' => 'GET'
    ],
    'city_list' => [
        'handler' => 'App\Controllers\CityController@show',
        'path' => '/city-list',
        'method' => 'GET'
    ],
    'region_list' => [
        'handler' => 'App\Controllers\CityController@showRegion',
        'path' => '/region-list',
        'method' => 'GET'
    ],
    'state_list' => [
        'handler' => 'App\Controllers\StatusController@showStatus',
        'path' => '/status-list',
        'method' => 'GET'
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
        'handler' => 'App\Controllers\ProductController@update',
        'path' => '/product',
        'method' => 'PUT',
        /* 'acl' => ['user', 'admin'] */
    ],
    'product_delete' => [
        'handler' => 'App\Controllers\ProductController@delete',
        'path' => '/product',
        'method' => 'DELETE',
        /* 'acl' => ['user', 'admin'] */
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
    ],
    'upload_img' => [
        'handler' => 'App\Controllers\ProductController@upload',
        'path' => '/upload_file',
        'method' => 'POST',
    ],
    'post_sort' => [
        'handler' => 'App\Controllers\SortController@sort',
        'path' => '/sort',
        'method' => 'POST',
    ]
];