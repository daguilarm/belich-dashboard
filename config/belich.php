<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application settings
    |--------------------------------------------------------------------------
    */

    //Application name
    'name' => 'Belich Dashboard',

    //This is the URI path where application will be accessible from
    'path' => '/dashboard',

    //Application url
    'url'  => env('APP_URL', '/'),

    //Fontawesome
    'fontAwesome' => true,

    /*
    |--------------------------------------------------------------------------
    | Navbar options
    | Options: 'top' or 'full'
    |--------------------------------------------------------------------------
    */
    'navbar'  => 'top',

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every dashboard route by default.
    |
    */
    'middleware' => [
        'web',
        'auth',
        'https',
    ],

    /*
    |--------------------------------------------------------------------------
    | Belich Authentication Guard
    |--------------------------------------------------------------------------
    |
    | This configuration option defines the authentication guard that will
    | be used to protect your Belich routes. This option should match one
    | of the authentication guards defined in the "auth" config file.
    |
    */
    'guard' => env('BELICH_GUARD', null),
];
