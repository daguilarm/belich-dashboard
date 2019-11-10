<?php

namespace Tests\Browser;

use App\User;
use Daguilarm\Belich\Facades\Helper;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter NavBarTest
class NavBarTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user;
    protected $avatar;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class, 'admin')->create();
        $this->avatar = htmlspecialchars(Helper::gravatar($this->user->email));
    }

    /**
     * Login test
     *
     * dusk --filter test_navbar
     * @return void
     */
    public function test_navbar()
    {
        $this->browse(function (Browser $browser) {
            //Test navigation
            $browser
                ->loginAs($this->user)
                ->assertAuthenticatedAs($this->user)
                ->visit('/dashboard')
                ->assertPathIs('/dashboard')
                ->click('@logout')
                ->assertSourceHas('<img src="' . $this->avatar . '" class="block h-10 rounded-full shadow-md" alt="My gravatar">')
                ->click('@logout-profile')
                ->assertPathIs('/dashboard/profiles/' . $this->user->id)
                ->assertSee($this->user->id)
                ->assertSee($this->user->name)
                ->assertSee($this->user->email)
                ->click('@button-action-edit')
                ->assertPathIs('/dashboard/profiles/' . $this->user->id . '/edit');
            //Test logout
            $browser
                ->click('@logout')
                ->click('@logout-session')
                ->assertPathIs('/dashboard/login')
                ->assertGuest();
        });
    }
}
