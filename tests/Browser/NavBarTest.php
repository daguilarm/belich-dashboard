<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter NavBarTest
class NavBarTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class, 'admin')->create();
    }

    /**
     * Login test
     *
     * dusk --filter test_navbar_user
     * @return void
     */
    public function test_navbar_user()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->assertAuthenticatedAs($this->user)
                ->visit('/dashboard')
                ->assertPathIs('/dashboard')
                ->click('@logout')
                ->click('@logout-profile')
                ->assertPathIs('/dashboard/profiles/' . $this->user->id)
                ->assertSee($this->user->id)
                ->assertSee($this->user->name)
                ->assertSee($this->user->email)
                ->assertSourceHas($this->user->profile->profile_avatar)
                ->click('@button-action-edit')
                ->assertPathIs('/dashboard/profiles/' . $this->user->id . '/edit');
        });
    }
}
