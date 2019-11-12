<?php

namespace Tests\Browser\IndexTable;

use App\Test;
use App\User;
use Daguilarm\Belich\Facades\Helper;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter ButtonsTest
class ButtonsTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->field = $this->setField('texts');
        factory(Test::class, 100)->create();
    }

    /**
     * Table create buttons
     *
     * dusk --filter test_table_create_buttons
     * @return void
     */
    public function test_table_create_buttons()
    {
        $this->browse(function (Browser $browser) {
            // Create buttons
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->click('@table-create-button')
                ->assertPathIs('/dashboard/' . $this->field . '/create');
        });
    }

    /**
     * Table results per page button
     *
     * dusk --filter test_table_perPage_buttons
     * @return void
     */
    public function test_table_perPage_buttons()
    {
        $this->browse(function (Browser $browser) {
            //Per page results
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->assertPresent('@button-options-options')
                ->assertMissing('.btn-dropdown-content')
                ->mouseover('@button-options-options')
                ->assertPresent('.btn-dropdown-content')
                ->select('perPage', 10)
                ->press('@table-options-submit')
                ->assertPathIs('/dashboard/' . $this->field);

            // Assert there is only 10 result
            $tableRows = count($browser->driver->findElements(WebDriverBy::cssSelector('#belich-index-table > tbody > tr')));
            $this->assertEquals($tableRows, 10);
        });
    }
}
