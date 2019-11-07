<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter BooleanTest
class BooleanTest extends DuskTestCase
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
        $this->field = $this->setField('booleans');
    }

    /**
     * Boolean color test
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
            //Testing on index
            $browser
                ->visit('dashboard/' . $this->field)
                ->assertSourceHas('<i class="fas fa-circle text-red-500"></i>')
                ->assertSourceHas('<i class="fas fa-circle text-blue-500"></i>');
        });
    }

    /**
     * Boolean color labels
     *
     * dusk --filter test_boolean_labels
     * @return void
     */
    public function test_boolean_labels()
    {
        $this->browse(function (Browser $browser) {
            //Current label
            $label = $this->test->test_boolean ? 'yes' : 'no';

            //Testing on index
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(11)', $label);
        });
    }

    /**
     * Boolean toggle test
     *
     * dusk --filter test_boolean_toggle
     * @return void
     */
    public function test_boolean_toggle()
    {
        $this->browse(function (Browser $browser) {
            // Testing on forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create');

            //Default value and current state
            $status = $browser->attribute('@dusk-test_boolean', 'value');
            $browser->assertInputValue('@dusk-test_boolean', $status);

            // Assert status change
            if($status === '0') {
                $browser
                    ->click('@label-test_boolean')
                    ->assertInputValue('@dusk-test_boolean', 1);
            } else {
                $browser
                    ->click('@label-test_boolean')
                    ->assertInputValue('@dusk-test_boolean', 0);
            }
        });
    }
}
