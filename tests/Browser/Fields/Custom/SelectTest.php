<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter SelectTest
class SelectTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 3)->create();
        $this->field = $this->setField('selectactions');
    }

    /**
     * Test select display using
     *
     * dusk --filter test_select_display
     */
    public function test_select_display()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                ->assertSourceHas('<td class="py-4 px-6 border-b border-solid border-gray-200 no-softdeleted"> Admin </td>')
                ->assertDontSeeIn('table.index-table > tbody > tr:nth-child(1) > td:nth-child(5)', '1')
                ->assertSourceHas('<td class="py-4 px-6 border-b border-solid border-gray-200 no-softdeleted"> Manager </td>')
                ->assertDontSeeIn('table.index-table > tbody > tr:nth-child(2) > td:nth-child(5)', '2')
                ->assertSourceHas('<td class="py-4 px-6 border-b border-solid border-gray-200 no-softdeleted"> User </td>')
                ->assertDontSeeIn('table.index-table > tbody > tr:nth-child(3) > td:nth-child(5)', '3')
                ->assertSeeIn('table.index-table > tbody > tr:nth-child(1) > td:nth-child(4)', '1')
                ->assertSeeIn('table.index-table > tbody > tr:nth-child(2) > td:nth-child(4)', '2')
                ->assertSeeIn('table.index-table > tbody > tr:nth-child(3) > td:nth-child(4)', '3');
        });
    }

    /**
     * Test select option values
     *
     * dusk --filter test_select_values
     */
    public function test_select_values()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user);
            // Create
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                // Testing DB values
                ->assertSelectHasOptions('#testing_db', User::pluck('id')->toArray())
                // Testing default value
                ->assertSelected('#testing_default', 2)
                ->assertNotSelected('#testing_default', 1);
            // Edit
            $browser
                ->visit('dashboard/' . $this->field . '/1/edit')
                ->assertSelected('#testing_db', 1)
                ->assertSelected('#testing_labels', 1)
                // FirstOptions
                ->assertSelectHasOption('#testing_options', '')
                ->assertSelectHasOption('#testing_default', 'No select')
                ->assertSelectHasOption('#testing_db', 'default');
        });
    }
}
