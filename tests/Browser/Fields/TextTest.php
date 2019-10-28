<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter TextTest
class TextTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create();
        $this->field = '_fieldtexts';
    }

    /**
     * Login test
     *
     * dusk --filter test_visibility
     * @return void
     */
    public function test_visibility()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                //App\Providers\DuskServiceProvider
                ->assertVisibility($this->field, $this->user);
        });
    }
}
