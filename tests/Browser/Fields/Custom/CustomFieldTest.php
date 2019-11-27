<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter CustomFieldTest
class CustomFieldTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 30)->create();
        $this->field = $this->setField('customs');
    }

    /**
     * Testing views
     *
     * dusk --filter test_custom_field_views
     * @return void
     */
    public function test_custom_field_views()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                // Index view
                ->visit('dashboard/' . $this->field)
                ->assertSourceHas('index[1][test_name]')
                ->assertSourceMissing('show[1][test_name]')
                // Create view
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input id="testing-id-1" class="mr-3" type="text" dusk="dusk-test_name" name="test_name">')
                ->assertSourceHas('<input id="testing-id-2" class="mr-3" type="text" dusk="dusk-test_name" name="test_name">')
                // Edit view
                ->visit('dashboard/' . $this->field . '/1/edit')
                ->assertSourceHas('<input id="testing-id-1" class="mr-3" type="text" value="testing-custom-value" dusk="dusk-test_name" name="test_name">')
                ->assertSourceMissing('<input id="testing-id-2"')
                // Show view
                ->visit('dashboard/' . $this->field . '/1')
                ->assertSourceHas('show[1][test_name]')
                ->assertSourceMissing('index[1][test_name]');
        });
    }
}
