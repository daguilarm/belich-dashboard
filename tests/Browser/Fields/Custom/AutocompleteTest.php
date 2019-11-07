<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter AutocompleteTest
class AutocompleteTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create([
            'id' => 1,
            'test_name' => 'Damian',
            'test_string' => 'Testing belich or something',
            'test_language' => 'php',
        ]);
        $this->test = factory(Test::class, 30)->create();
        $this->field = $this->setField('autocompletes');
        $this->fieldActions = $this->setField('autocompleteactions');
    }

    /**
     * Custom attributes test
     *
     * dusk --filter test_autocomplete_focus
     * @return void
     */
    public function test_autocomplete_focus()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                // Test autofocus
                ->assertFocused('@datalist-input-test_autofocus');
        });
    }

    /**
     * Ajax autocomplete test: Storing the value.
     *
     * dusk --filter test_autocomplete_ajax_storing_value
     */
    public function test_autocomplete_ajax_storing_value()
    {
        $this->browse(function (Browser $browser) {
            $hidden = '@datalist-test_name';
            $input = '@datalist-input-test_name';
            $datalist = '@datalist-info-test_name';

            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->fieldActions . '/1/edit')
                ->assertVisible($input)
                ->assertMissing($datalist)
                ->type($input, 'Dam')
                ->waitFor($datalist)
                ->assertVisible($datalist)
                ->assertSee('Damian')
                ->click('li[data-value="Damian"]')
                ->assertInputValue($hidden, 'Damian')
                ->assertMissing($datalist);
        });
    }

    /**
     *Ajax autocomplete test: Storing the id.
     *
     * dusk --filter test_autocomplete_ajax_storing_id
     */
    public function test_autocomplete_ajax_storing_id()
    {
        $this->browse(function (Browser $browser) {
            $hidden = '@datalist-test_string';
            $input = '@datalist-input-test_string';
            $datalist = '@datalist-info-test_string';
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->fieldActions . '/1/edit')
                ->assertVisible($input)
                ->assertMissing($datalist)
                ->type($input, 'belich')
                ->waitFor($datalist)
                ->assertVisible($datalist)
                ->assertSee('Testing belich or something')
                ->click('li[data-value="1"]')
                ->assertInputValue($hidden, 1)
                ->assertMissing($datalist);
        });
    }
}
