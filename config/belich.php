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
    |
    */
    'middleware' => [
        'https',
        'web',
        'auth',
    ],

    /*
    |--------------------------------------------------------------------------
    | Export file (xls, xlsx, csv) from supported drivers
    |--------------------------------------------------------------------------
    |
    | Belich has support for:
    |
    | @Driver: Fast Excel
    | @Github: https://github.com/rap2hpoutre/fast-excel
    | @value: 'fast-excel'
    |
    | @Driver: Laravel Maatwebsite excel (comming soon...)
    | @Github: https://laravel-excel.maatwebsite.nl/
    | @value: 'maatwebsite'
    |
    */
    'export' => [
        'driver' => 'fast-excel',
    ],

    /*
    |--------------------------------------------------------------------------
    | Hide metrics for a different screen sizes
    |--------------------------------------------------------------------------
    |
    | Belich will allow you to hide metrics base on the device and its screen-size: mobile, tables, etc.
    | The allowed values are: 'sm', 'md', 'lg' and  'xl'
    */
    'hideMetricsForScreens' => [],

    /*
    |--------------------------------------------------------------------------
    | Hide cards for a different screen sizes
    |--------------------------------------------------------------------------
    |
    | Belich will allow you to hide cards base on the device and its screen-size: mobile, tables, etc.
    | The allowed values are: 'sm', 'md', 'lg' and  'xl'
    */
    'hideCardsForScreens' => [],

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

    /*
    |--------------------------------------------------------------------------
    | Minify html
    |--------------------------------------------------------------------------
    |
    | Belich will minify the html before blade create the cache for the views
    | The allowed actions for the except are: dashboard, index, edit, create, show,...
    | For the paths, use only the $request->path().
    | For example, if the current url is: https://url.com/dashboard/2/users/ the correct path for this url will be: dashboard/2/users
    | Don't worry about slashes... there is no different between dashboard/2/users or /dashboard/2/users/ for Belich!
    */
    'minifyHtml' => [
        'enable'    => true,
        'except'  => [
            'actions' => [], //['index', 'show']
            'paths'   => [], //['dashboard/', 'dashboard/users/create']
        ],
    ],
];
