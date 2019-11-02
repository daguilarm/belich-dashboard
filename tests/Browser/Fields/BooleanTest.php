<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter BooleanTest
class BooleanTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $asHtml;
    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create();
        $this->field = '_fieldbooleans';
    }

    /**
     * Visibility test
     *
     * dusk --filter test_boolean_visibility
     * @return void
     */
    public function test_boolean_visibility()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                //App\Providers\DuskServiceProvider
                ->assertVisibility($this->user, $this->field);
        });
    }

    /**
     * Attributes test
     *
     * dusk --filter test_boolean_attributes
     * @return void
     */
    public function test_boolean_attributes()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                //App\Providers\DuskServiceProvider
                ->exceptAttributes(['addClass', 'autofocus', 'prefix', 'resolve', 'display'])
                ->assertAttributes($this->user, $this->test, $this->field, '');
        });
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

            //Default value
            $status = $browser->attribute('@dusk-test_boolean', 'value');

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

    /**
     * Authorization test
     *
     * dusk --filter test_boolean_authorization
     * @return void
     */
    public function test_boolean_authorization()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertPresent('#testing_can_see')
                ->assertMissing('#testing_cannot_see');
        });
    }
}
