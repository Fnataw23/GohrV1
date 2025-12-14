<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Sub-Domain Routing
    |--------------------------------------------------------------------------
    |
    | You can use the admin panel on a separate subdomain.
    | For example: 'admin.example.com'
    |
    */

    'domain' => env('ORCHID_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | Route Prefixes
    |--------------------------------------------------------------------------
    |
    | This prefix method can be used for the prefix of each
    | route in the administration panel. For example, you can change to 'admin'
    |
    */

    'prefix' => env('ORCHID_PREFIX', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | This middleware will be assigned to every route, giving you the
    | chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        'orchid.admin', // Твой middleware
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    |
    | Available settings for authentication.
    |
    */

    'auth' => [
        'model' => \App\Models\User::class, // Твоя модель User
    ],

    /*
    |--------------------------------------------------------------------------
    | Resource
    |--------------------------------------------------------------------------
    |
    | Models that will be used in the admin panel for CRUD operations.
    |
    */

    'models' => [
        'user' => \App\Models\User::class, // Твоя модель User
    ],

    /*
    |--------------------------------------------------------------------------
    | Available menu items
    |--------------------------------------------------------------------------
    |
    | A list of menu items that will be displayed on the main dashboard.
    | You can add your own items to this list.
    |
    */

    'menu' => [
        'header' => 'Main Navigation',
        // Примеры пунктов меню
        // 'main' => [
        //     'icon' => 'bs.house',
        //     'route' => 'platform.index',
        //     'title' => 'Dashboard',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default configuration for attachments.
    |--------------------------------------------------------------------------
    |
    | Strategy properties for the file upload manager.
    |
    */

    'attachment' => [
        'disk' => env('ORCHID_ATTACHMENT_DISK', 'public'),
        'generator' => \Orchid\Attachment\Engines\Generator::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Icons Path
    |--------------------------------------------------------------------------
    |
    | Provide the path from your app to your SVG icons directory.
    |
    */

    'icons' => [
        'bs' => [
            'path' => '/vendor/orchid/icons/bootstrap-icons.svg',
            'prefix' => 'bi-',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    |
    | It is a channel for displaying notifications in the user interface.
    |
    */

    'notifications' => [
        'enabled' => true,
        'ttl' => 3600,
    ],

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    |
    | List of models available for search. Defaults to 'App\Models\User'
    |
    */

    'search' => [
        \App\Models\User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Hotwire Turbo
    |--------------------------------------------------------------------------
    |
    | Turbo Drive keeps navigation snappy by preventing full-page reloads.
    | You can enable or disable this feature.
    |
    */

    'turbo' => [
        'enabled' => env('ORCHID_TURBO_ENABLED', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Fallback Page
    |--------------------------------------------------------------------------
    |
    | If the request does not match any route and arguments,
    | Orchid will render this fallback page.
    |
    */

    'fallback' => [
        'enabled' => true,
        'view' => 'errors.404',
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Query String
    |--------------------------------------------------------------------------
    |
    | You can pass query string parameters that will be added to every request.
    |
    */

    'global_query_string' => [
        // 'theme' => 'dark',
    ],
];
