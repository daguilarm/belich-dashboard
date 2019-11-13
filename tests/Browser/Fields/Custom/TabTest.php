<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter TabTest
class TabTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 10)->create();
        $this->field = $this->setField('tabs');
    }

    /**
     * Test Tabs visibility
     *
     * dusk --filter test_tabs_visibility
     */
    public function test_tabs_visibility()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                ->assertMissing('.tabs')
                ->visit('dashboard/' . $this->field . '/create')
                ->assertVisible('.tabs')
                ->visit('dashboard/' . $this->field . '/1')
                ->assertVisible('.tabs')
                ->visit('dashboard/' . $this->field . '/1/edit')
                ->assertVisible('.tabs');
        });
    }

    /**
     * Test Tabs validation errors
     *
     * dusk --filter test_tabs_validation_errors
     */
    public function test_tabs_validation_errors()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertMissing('.tab-error')
                ->press('@button-action-create')
                ->waitFor('a#menu_panel1.tab-error')
                ->assertVisible('a#menu_panel2.tab-error')
                ->type('#test_name', 'Damián')
                ->type('#test_email', 'damian.aguilarm@gmail.com')
                ->press('@button-action-create')
                ->waitFor('a#menu_panel2.tab-error')
                ->assertMissing('a#menu_panel1.tab-error');
        });
    }
}
