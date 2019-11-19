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
                ->assertSourceHas('<td class="py-4 px-6 border-b border-solid border-gray-200 no-softdeleted"> Manager </td>')
                ->assertSourceHas('<td class="py-4 px-6 border-b border-solid border-gray-200 no-softdeleted"> User </td>')
                ->assertSourceMissing('<td class="py-4 px-6 border-b border-solid border-gray-200 no-softdeleted"> 1 </td>')
                ->assertSourceMissing('<td class="py-4 px-6 border-b border-solid border-gray-200 no-softdeleted"> 2 </td>')
                ->assertSourceMissing('<td class="py-4 px-6 border-b border-solid border-gray-200 no-softdeleted"> 3 </td>');
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
                ->visit('dashboard/' . $this->field . '/create')
                // Testing DB values
                ->assertSelectHasOptions('#testing_db', User::pluck('id')->toArray())
                // Testing array values
                ->assertSelectHasOptions('#testing_options', [1, 2, 3])
                ->assertSelectMissingOptions('#testing_options', [4, 5, 6])
                // Testing default value
                ->assertSelected('#testing_default', 2)
                ->assertNotSelected('#testing_default', 1);
            // Edit
            $browser
                ->visit('dashboard/' . $this->field . '/1/edit')
                ->assertSelected('#testing_db', 1)
                ->assertSelected('#testing_labels', 1);
        });
    }
}
