<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

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
                ->pause(2000);
        });
    }
}
