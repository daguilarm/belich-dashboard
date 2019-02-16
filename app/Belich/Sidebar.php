<?php

namespace App\Belich;

use Daguilarm\Belich\Components\Navigation\NavBuilder;
use Illuminate\Support\Collection;
use Spatie\Menu\Html;
use Spatie\Menu\Link;
use Spatie\Menu\Menu;

class Sidebar extends NavBuilder {

    /**
     * Generate the navbar
     *
     * @param Illuminate\Support\Collection $resources
     * @return void
     */
    public static function make(Collection $resources)
    {

    }
}
