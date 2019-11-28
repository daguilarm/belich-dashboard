<?php

namespace Tests\Browser\Index;

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
        factory(Test::class, 15)->create();
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
     * dusk --filter test_table_perPage_button
     * @return void
     */
    public function test_table_perPage_button()
    {
        $this->browse(function (Browser $browser) {
            //Per page results
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->assertVisible('@button-options-options')
                ->assertMissing('#belich-form-options')
                ->mouseover('@button-options-options')
                ->assertVisible('#belich-form-options')
                ->select('perPage', 10)
                ->press('@table-options-submit')
                ->assertPathIs('/dashboard/' . $this->field);

            // Assert there is only 10 result
            $tableRows = count($browser->driver->findElements(WebDriverBy::cssSelector('table.index-table > tbody > tr')));
            $this->assertEquals($tableRows, 10);
        });
    }

    /**
     * Table download button
     *
     * dusk --filter test_table_download_button
     * @return void
     */
    public function test_table_download_button()
    {
        $this->browse(function (Browser $browser) {
            //Download file
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->assertMissing('@button-options-exports')
                ->assertMissing('#belich-form-exports')
                ->click('@index-table-select-all')
                ->assertVisible('@button-options-exports')
                ->mouseover('@button-options-exports')
                ->assertVisible('#belich-form-exports')
                ->assertSelectHasOptions('select[name=format]', ['xls', 'xlsx', 'csv'])
                ->assertSelectHasOptions('select[name=quantity]', ['all', 'selected'])
                ->assertVisible('@table-export-submit');
        });
    }

    /**
     * Table mass delete button
     *
     * dusk --filter test_table_mass_delete_button
     * @return void
     */
    public function test_table_mass_delete_button()
    {
        $this->browse(function (Browser $browser) {
            //Download file
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->assertMissing('@button-options-delete')
                ->assertMissing('@modal-mass-delete')
                ->click('@index-table-select-all')
                ->assertVisible('@button-options-delete')
                ->click('@button-options-delete')
                ->waitFor('#modal-mass-delete')
                ->press('@modal-mass-delete-confirm-button');

            // Assert all the items are deleted
            // At this point is showing 10 results per page, so...
            $this->assertEquals(Test::all()->count(), 5);
        });
    }
}
