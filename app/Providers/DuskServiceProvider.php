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
        // Assert a field exists
        Browser::macro('assertExists', function ($element) {
            return count($this->driver->findElements(WebDriverBy::cssSelector($element))) > 0
                ? true
                : false;
        });

        // Add value to hidden field
        Browser::macro('fillHidden', function ($name , $value) {
            $this->script("document.getElementsByName('$name')[0].value = '$value'");

            return $this;
        });

        // Select a option (using its position) from a select
        Browser::macro('selectOption', function ($element, $position) {
            $this->script("$('select[name=\"{$element}\"] option:eq({$position})').attr('selected', 'selected');");

            return $this;
        });

        // Select a random option from a radio button
        Browser::macro('selectRadioOption', function ($radioElement) {
            $radio_options = $this->driver->findElements(WebDriverBy::name($radioElement));
            $radio_options[array_rand($radio_options)]->click();
        });

        // Wait until the page is reload
        Browser::macro('waitForReload', function () {
            $this->driver->executeScript('window.oldPageStillIn = {}');
            $callable();

            return $this->waitUntil("return typeof window.oldPageStillIn === 'undefined';");
        });
    }
}
