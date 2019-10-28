<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter LoginTest
class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Login test
     *
     * dusk --filter test_login
     * @return void
     */
    public function test_login()
    {
        $user = factory(User::class, 'admin')->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->visit('dashboard/login')
                ->type('email', 'admin@email.com')
                ->type('password', 'admin')
                ->press('Login')
                ->assertAuthenticatedAs($user)
                ->logout()
                ->assertGuest();
        });
    }
}
