<?php

namespace Tests\Browser\Fields\Visibility;

use App\User;
use Laravel\Dusk\Browser;

trait VisibilityHelper
{
    /**
     * Visibility helper
     *
     * @param Laravel\Dusk\Browser $browser
     * @param string $page
     * @param App\User $user
     *
     * @return Browser
     */
    private static function assertVisibility(Browser $browser, User $user, string $page): Browser
    {
        // INDEX visibility
        return
            $browser->visit('dashboard/' . $page)
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
}
