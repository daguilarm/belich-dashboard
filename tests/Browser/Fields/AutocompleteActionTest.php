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
        $this->test = factory(Test::class, 50)->create();
        $this->field = '_fieldautocompleteactions';
    }

    /**
     * Ajax autocomplete test
     *
     * dusk --filter test_autocomplete_ajax
     * @return void
     */
    public function test_autocomplete_ajax()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/1/edit');
        });
    }
}
