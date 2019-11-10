<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Attributes\AttributesHelper;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter HiddenTest
class HiddenTest extends DuskTestCase
{
    use AttributesHelper, DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->test = factory(Test::class)->create();
        $this->field = $this->setField('hiddens');
    }

    /**
     * Testing visibility: only on forms
     *
     * dusk --filter test_hidden_visibility
     * @return void
     */
    public function test_hidden_visibility()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                    ->assertMissing('@testing-dusk')
                ->visit('dashboard/' . $this->field . '/1')
                    ->assertMissing('@testing-dusk')
                ->visit('dashboard/' . $this->field .'/create')
                    ->assertPresent('@testing-dusk')
                ->visit('dashboard/' . $this->field . '/1/edit')
                    ->assertInputValue('@testing-dusk', $this->test->test_email);
        });
    }

    /**
     * Testing attributes
     *
     * dusk --filter test_hidden_attributes
     * @return void
     */
    public function test_hidden_attributes()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertPathIs('/dashboard/' . $this->field . '/create')
                ->assertPresent('#testing_id')
                ->assertPresent('@testing-dusk')
                ->assertPresent('[name="testing-name"]')
                ->assertPresent('[data-test="testing-data"]')
                ->assertPresent('[disabled]');
        });
    }
}
