<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter AutocompleteActionTest
class AutocompleteActionTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $asHtml;
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
        $this->test = factory(Test::class, 50)->create();
        $this->field = '_fieldautocompleteactions';
    }

    /**
     * Ajax autocomplete test
     *
     * dusk --filter test_autocomplete_ajax_storing_name_value
     * @return void
     */
    public function test_autocomplete_ajax_storing_name_value()
    {
        $this->browse(function (Browser $browser) {
            $hidden = '@datalist-test_name';
            $input = '@datalist-input-test_name';
            $datalist = '@datalist-info-test_name';

            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/1/edit')
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
     * Ajax autocomplete (storing id as value) test
     *
     * dusk --filter test_autocomplete_ajax_storing_id_value
     * @return void
     */
    public function test_autocomplete_ajax_storing_id_value()
    {
        $this->browse(function (Browser $browser) {
            $hidden = '@datalist-test_string';
            $input = '@datalist-input-test_string';
            $datalist = '@datalist-info-test_string';
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/1/edit')
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

    //Not possible to deal with datalist > option

    // /**
    //  * Array autocomplete
    //  *
    //  * dusk --filter test_autocomplete_array
    //  * @return void
    //  */
    // public function test_autocomplete_array()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $hidden = '@datalist-test_language';
    //         $input = '@datalist-input-test_language';
    //         $datalist = '@datalist-info-test_language';
    //         $browser
    //             ->loginAs($this->user)
    //             ->visit('dashboard/' . $this->field . '/1/edit')
    //             ->assertVisible($input)
    //             ->assertMissing($datalist)
    //             ->type($input, 'ph')->pause(400)
    //             ->click('#list_95541d8715d350d366f97396de1bfa70 > option:nth-child(1)')
    //             ->assertInputValue($hidden, 'php')
    //             ->assertMissing($datalist);
    //     });
    // }
}
