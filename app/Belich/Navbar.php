<?php

namespace App\Belich;

use Daguilarm\Belich\Components\Navigation\Navbar as BaseNavbar;

class Navbar extends BaseNavbar {

    /**
     * Generate the navbar
     *
     * @param Illuminate\Support\Collection $resources
     * @return void
     */
    public function get()
    {
        //Generate the navbar without resources
        if(config('belich.navbar') === 'sidebar') {
            return Parent::navbarWithoutResources()
                ->menu
                ->render();
        }

        return Parent::navbarWithResources()
            ->menu
            ->render();
    }
}
