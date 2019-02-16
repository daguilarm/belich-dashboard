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

    /*
    |--------------------------------------------------------------------------
    | Navbar options
    | Options: 'top' or 'sidebar'
    |--------------------------------------------------------------------------
    */
    'navbar'  => 'top',

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every dashboard route by default.
    | You can add your own middleware to the list.
    | Remember that Laravel need the 'web' and 'auth' middleware...
    |
    */
    'middleware' => [
        'https',
        'web',
        'auth',
    ],

    /*
    |--------------------------------------------------------------------------
    | Url allowed parameters
    |--------------------------------------------------------------------------
    |
    | Belich only allows a list of predetermined parameters. If you need your own url
    | parameters, please, add this to this variable...
    |
    */
    'allowedUrlParameters' => [],
];
