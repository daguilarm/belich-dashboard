<?php

namespace App\Belich;

use Daguilarm\Belich\Components\Navigation;
use Illuminate\Support\Collection;
use Spatie\Menu\Html;
use Spatie\Menu\Link;
use Spatie\Menu\Menu;

class Navbar extends Navigation {

    /**
     * Generate the navbar
     *
     * @param Illuminate\Support\Collection $resources
     * @return void
     */
    public static function make(Collection $resources)
    {
        //Generate the default navbar from the resources
        return Parent::resourcesForNavigation($resources);
    }
}
