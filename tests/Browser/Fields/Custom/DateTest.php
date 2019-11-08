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
     * Date numeric test
     *
     * dusk --filter test_date_numeric
     * @return void
     */
    public function test_date_numeric()
    {
        $this->browse(function (Browser $browser) {
            // Testing on forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertInputValue('@dusk-test_autofocus', '')
                ->type('@dusk-test_autofocus', '10/10/2010')
                ->assertInputValue('@dusk-test_autofocus', '2010-10-10')
                ->clear('@dusk-test_autofocus')
                ->type('@dusk-test_autofocus', 'aa')
                ->assertInputValueIsNot('@dusk-test_autofocus', 'aa')
                ->assertInputValue('@dusk-test_autofocus', '');
        });
    }
}
