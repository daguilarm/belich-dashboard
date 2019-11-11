<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter PatternTest
class PatternTest extends DuskTestCase
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
        $this->field = $this->setField('patterns');
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
     * Test pattern fields
     *
     * dusk --filter test_pattern_field
     */
    public function test_pattern_field()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create');
        });
    }
}
