<?php

namespace App\Providers;

use App\Test;
use App\User;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;

class DuskServiceProvider extends ServiceProvider
{
    public static $except = [];

    /**
     * Register the Dusk's browser macros.
     *
     * @return void
     */
    public function boot()
    {
        //Nothing
    }
}
