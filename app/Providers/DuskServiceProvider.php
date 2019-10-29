<?php

namespace App\Providers;

use App\Test;
use App\User;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;

class DuskServiceProvider extends ServiceProvider
{
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
        return $browser
            ->visit('dashboard/' . $page)
                // asHtml()
                ->assertSourceHas($html)
                // prefix() and suffix()
                ->assertSee('***' . $test->test_name . '***')
                //resolveUsing()
                ->assertSee('resolved ' . $test->test_email)
                //displayUsing()
                ->assertSee(strtoupper($test->test_name))
            ->visit('dashboard/' . $page . '/' . $user->id . '/edit')
                ->assertVisible('#testing-id.testing-class')
                ->assertVisible('#testing-id')
                ->assertVisible('[name="testing-name"]')
                ->assertVisible('[data-test="testing-data"]')
                ->assertVisible('[disabled]')
                ->assertVisible('[readonly]')
                ->assertVisible('[dusk="testing-dusk"]')
                //asHtml() don't see in edit view
                ->assertSourceMissing($html)
            ->visit('dashboard/' . $page . '/create')
                // help()
                ->assertSourceHas('<div class="font-normal lowercase italic mt-2 uppercase-first-letter">testing help</div>')
                // defaultValue()
                ->assertVisible('[value="testing-value"]')
                // autofocus()
                ->assertFocused('#testing-focus')
                //asHtml() don't see in create view
                ->assertSourceMissing($html);
    }
}
