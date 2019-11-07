<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter DateTest
class DateTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->test = factory(Test::class)->create();
        $this->field = $this->setField('dates');
    }

    /**
     * Date color test
     *
     * dusk --filter test_boolean_colors
     * @return void
     */
    public function test_boolean_colors()
    {
        $this->browse(function (Browser $browser) {
            // Testing on forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertPresent('input.itoggle.red')
                ->assertPresent('input#boolean_color_red.itoggle.red')
                ->assertPresent('input#boolean_color_blue.itoggle.blue');
        });
    }
}
