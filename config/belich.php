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
    Application with profile as resource
    ------------------------------------
    If you decide to remove this feature, don't forget to remove the file \App\Belich\Resources\Profile.php
    or disable the static property for display the resource in the navigation bar in \App\Belich\Resources\Profile.php: $displayInNavigation = false;
    */
    'profile' => true,

    /*
    |--------------------------------------------------------------------------
    | Navbar options
    | Options: 'top' or 'sidebar'
    |--------------------------------------------------------------------------
    */
    'navbar' => [
        'display' => 'top',
        // 'defaultIcon' => 'caret-right',
    ],

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
    |
    */
    'export' => [
        'driver' => 'fast-excel',
    ],

    /*
    |--------------------------------------------------------------------------
    | Hide components (metrics or cards) for a different screen sizes
    |--------------------------------------------------------------------------
    |
    | Belich will allow you to hide metrics or cards base on the device and its screen-size: mobile, tables, etc.
    | The allowed values are: 'sm', 'md', 'lg' and  'xl'
    */
    'hideComponentsForScreens' => [],

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

    /*
    |--------------------------------------------------------------------------
    | Date format
    |--------------------------------------------------------------------------
    |
    | Define the default date format. This format will be use in the Controller actions: index and show.
    */
    'dateFormat' => 'd/m/Y',

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Define the paginate style. Two styles available: link or simple
    */
    'pagination' => 'link',

    /*
    |--------------------------------------------------------------------------
    | Live search
    |--------------------------------------------------------------------------
    |
    | Activate live search and define the minimum number of characters for start: live search
    */
    'liveSearch' => [
        'enable' => true,
        'minChars' => 2,
    ],

    /*
    |--------------------------------------------------------------------------
    | Field textArea and markdown
    |--------------------------------------------------------------------------
    |
    | Define the maximun number of characters for the textArea or a markdown
    | For example, if the textArea value is: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
    | IF the textAreaChars value is 20, will show: "Lorem ipsum dolor si..."
    */
    'textAreaChars' => 25,

    /*
    |--------------------------------------------------------------------------
    | Loading status
    |--------------------------------------------------------------------------
    |
    | Show the loading icon for ajax queries
    */
    'loading' => '<i class="fas fa-spinner fa-spin fa-10x text-blue-200"></i>',
];
