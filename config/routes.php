<?php

return [
    'index' => [
        'handler' => 'App\Controllers\ProductController@index',
        'path' => '/products',
        'method' => 'POST'
    ],
    'categories_list' => [
        'handler' => 'App\Controllers\CategoriesController@show',
        'path' => '/categories-list'
    ],
    'city_list' => [
        'handler' => 'App\Controllers\CityController@show',
        'path' => '/city-list'
    ],
    'region_list' => [
        'handler' => 'App\Controllers\CityController@showRegion',
        'path' => '/region-list'
    ],
    'state_list' => [
        'handler' => 'App\Controllers\StatusController@showStatus',
        'path' => '/status-list'
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
    'upload' => [
        'handler' => 'App\Controllers\ProductController@upload',
        'path' => '/upload_file',
        'method' => 'POST',
    ],
    'post_sort' => [
        'handler' => 'App\Controllers\SortController@sort',
        'path' => '/sort',
        'method' => 'POST',
    ],
    'post_sort_gategory' => [
        'handler' => 'App\Controllers\SortController@sortCategory',
        'path' => '/sort-category',
        'method' => 'POST',
    ],
    'search_post' => [
        'handler' => 'App\Controllers\SortController@search',
        'path' => '/search-post',
        'method' => 'POST',
    ]
];