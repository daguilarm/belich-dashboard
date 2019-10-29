<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter AutocompleteTest
class AutocompleteTest extends DuskTestCase
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
        $this->test = factory(Test::class)->create();
        $this->field = '_fieldautocompletes';
        $this->asHtml = '<h1 class="text-red-500">Hello world</h1>';
    }

    /**
     * Visibility test
     *
     * dusk --filter test_autocomplete_visibility
     * @return void
     */
    public function test_autocomplete_visibility()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                //App\Providers\DuskServiceProvider
                ->assertVisibility($this->user, $this->field);
        });
    }

    /**
     * Attributes test
     *
     * dusk --filter test_autocomplete_attributes
     * @return void
     */
    public function test_autocomplete_attributes()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                //App\Providers\DuskServiceProvider
                ->assertAttributes($this->user, $this->test, $this->field, $this->asHtml);
        });
    }

    /**
     * Autofocus test
     *
     * dusk --filter test_autocomplete_autofocus
     * @return void
     */
    public function test_autocomplete_autofocus()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertFocused('@dusk-autocomplete-test_autofocus');
        });
    }

    /**
     * Authorization test
     *
     * dusk --filter test_autocomplete_authorization
     * @return void
     */
    public function test_autocomplete_authorization()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertVisible('[name="testing_can_see"]')
                ->assertMissing('[name="testing_cannot_see"]');
        });
    }
}
