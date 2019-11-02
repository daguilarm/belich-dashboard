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
        Browser::macro('assertVisibility', function ($user, $page) {
            return DuskServiceProvider::assertVisibilityTest($this, $user, $page);
        });

        Browser::macro('assertAttributes', function ($user, $test, $page, $html) {
            return DuskServiceProvider::assertAttributes($this, $user, $test, $page, $html);
        });

        Browser::macro('exceptAttributes', function ($except) {
            return DuskServiceProvider::exceptAttributes($this, $except);
        });
    }

    /**
     * Visibility test
     *
     * @param Laravel\Dusk\Browser $browser
     * @param App\User $user
     * @param string $page
     * @return Browser
     */
    public static function assertVisibilityTest(Browser $browser, User $user, string $page) : Browser
    {
        return $browser
            // INDEX visibility
            ->visit('dashboard/' . $page)
                ->assertSee(strtoupper('Except on forms'))
                ->assertSee(strtoupper('Hide when creating'))
                ->assertSee(strtoupper('Hide when editing'))
                ->assertDontSee(strtoupper('Hide from index'))
                ->assertDontSee(strtoupper('Hide-from index'))
                ->assertSee(strtoupper('Hide from show'))
                ->assertDontSee(strtoupper('Only on forms'))
                ->assertSee(strtoupper('Only on index'))
                ->assertDontSee(strtoupper('Only on show'))
                ->assertSee(strtoupper('Visible-on index'))
            // SHOW visibility
            ->visit('dashboard/' . $page . '/' . $user->id)
                ->assertSee(ucwords('Except on forms'))
                ->assertSee(ucwords('Hide when creating'))
                ->assertSee(ucwords('Hide when editing'))
                ->assertSee(ucwords('Hide from index'))
                ->assertSee(ucwords('Hide-From index'))
                ->assertDontSee(ucwords('Hide from show'))
                ->assertDontSee(ucwords('Only on forms'))
                ->assertDontSee(ucwords('Only on index'))
                ->assertSee(ucwords('Only on show'))
                ->assertDontSee(ucwords('Visible-On index'))
            // EDIT visibility
            ->visit('dashboard/' . $page . '/' . $user->id . '/edit')
                ->assertDontSee(ucwords('Except on forms'))
                ->assertSee(ucwords('Hide when creating'))
                ->assertDontSee(ucwords('Hide when editing'))
                ->assertSee(ucwords('Hide from index'))
                ->assertSee(ucwords('Hide-From index'))
                ->assertSee(ucwords('Hide from show'))
                ->assertSee(ucwords('Only on forms'))
                ->assertDontSee(ucwords('Only on index'))
                ->assertDontSee(ucwords('Only on show'))
                ->assertDontSee(ucwords('Visible-On index'))
            // CREATE visibility
            ->visit('dashboard/' . $page . '/create')
                ->assertDontSee(ucwords('Except on forms'))
                ->assertDontSee(ucwords('Hide when creating'))
                ->assertSee(ucwords('Hide when editing'))
                ->assertSee(ucwords('Hide from index'))
                ->assertSee(ucwords('Hide-From index'))
                ->assertSee(ucwords('Hide from show'))
                ->assertSee(ucwords('Only on forms'))
                ->assertDontSee(ucwords('Only on index'))
                ->assertDontSee(ucwords('Only on show'))
                ->assertDontSee(ucwords('Visible-On index'));
    }

    /**
     * Attributes test
     *
     * @param Laravel\Dusk\Browser $browser
     * @param App\User $user
     * @param App\Test $test
     * @param string $page
     * @param string $html
     * @return Browser
     */
    public static function assertAttributes(Browser $browser, User $user, Test $test, string $page, string $html) : Browser
    {
        $browser->visit('dashboard/' . $page . '/' . $user->id . '/edit');
            if(!in_array('id', static::$except)) {
                $browser->assertPresent('#testing_id');
            }
            if(!in_array('dusk', static::$except)) {
                $browser->assertPresent('[dusk="testing-dusk"]');
            }
            if(!in_array('name', static::$except)) {
                $browser->assertVisible('[name="testing-name"]');
            }
            if(!in_array('data-test', static::$except)) {
                $browser->assertVisible('[data-test="testing-data"]');
            }
            if(!in_array('disabled', static::$except)) {
                $browser->assertVisible('[disabled]');
            }
            if(!in_array('readonly', static::$except)) {
                $browser->assertVisible('[readonly]');
            }
            if(!in_array('asHtml', static::$except)) {
                //$field->asHtml() don't see in edit view
                $browser->assertSourceMissing($html);
            }
            if(!in_array('addClass', static::$except)) {
                $browser
                    ->assertVisible('.testing-class')
                    ->assertVisible('.text-center');
            }
            if(!in_array('autofocus', static::$except)) {
                $browser->assertFocused('@dusk-test_autofocus');
            }

        $browser->visit('dashboard/' . $page . '/create');
            if(!in_array('help', static::$except)) {
                $browser->assertSourceHas('<div class="font-normal lowercase italic mt-2 uppercase-first-letter">testing help</div>');
            }
            if(!in_array('defaultValue', static::$except)) {
                $browser->assertVisible('[value="testing-value"]');
            }
            if(!in_array('asHtml', static::$except)) {
                //asHtml() don't see in create view
                $browser->assertSourceMissing($html);
            }
        //Index
        if(!in_array('index', static::$except)) {
            $browser->visit('dashboard/' . $page);
                if(!in_array('prefix', static::$except)) {
                    // For prefix and sufix
                    $browser->assertSee('***' . $test->test_name . '***');
                }
                if(!in_array('resolve', static::$except)) {
                    //$field->resolveUsing()
                    $browser->assertSee('resolved ' . $test->test_email);
                }
                if(!in_array('display', static::$except)) {
                    //$field->displayUsing()
                    $browser->assertSee(strtoupper($test->test_name));
                }
        }

        return $browser;
    }

    /**
     * Attributes test
     *
     * @param Laravel\Dusk\Browser $browser
     * @param array $except
     * @return Browser
     */
    public static function exceptAttributes(Browser $browser, array $except) {
        static::$except = $except;

        return $browser;
    }
}
