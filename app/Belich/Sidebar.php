<?php

namespace App\Belich;

use Daguilarm\Belich\Components\Navigation\Navbar as BaseNavbar;

class Sidebar extends BaseNavbar {

    /**
     * Generate the navbar
     *
     * @return void
     */
    public function get()
    {
        return Parent::sidebarWithResources()
            ->menu
            ->render();
    }
}
