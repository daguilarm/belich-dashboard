<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter TextTest
class TextTest extends DuskTestCase
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
        $this->field = '_fieldtexts';
        $this->asHtml = '<h1 class="text-red-500">Hello world</h1>';
    }

    /**
     * Login test
     *
     * dusk --filter test_text_visibility
     * @return void
     */
    public function test_text_visibility()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                //App\Providers\DuskServiceProvider
                ->assertVisibility($this->field, $this->user);
        });
    }

    /**
     * Login test
     *
     * dusk --filter test_text_attributes
     * @return void
     */
    public function test_text_attributes()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                    // asHtml()
                    ->assertSourceHas($this->asHtml)
                    // prefix() and suffix()
                    ->assertSee('***' . $this->test->test_name . '***')
                    //resolveUsing()
                    ->assertSee('resolved ' . $this->test->test_email)
                    //displayUsing()
                    ->assertSee(strtoupper($this->test->test_name))
                ->visit('dashboard/' . $this->field . '/' . $this->user->id . '/edit')
                    ->assertVisible('#testing-id.testing-class')
                    ->assertVisible('#testing-id')
                    ->assertVisible('[name="testing-name"]')
                    ->assertVisible('[data-test="testing-data"]')
                    ->assertVisible('[disabled]')
                    ->assertVisible('[readonly]')
                    ->assertVisible('[dusk="testing-dusk"]')
                    //asHtml() don't see in edit view
                    ->assertSourceMissing($this->asHtml)
                ->visit('dashboard/' . $this->field . '/create')
                    // help()
                    ->assertSourceHas('<div class="font-normal lowercase italic mt-2 uppercase-first-letter">testing help</div>')
                    // defaultValue()
                    ->assertVisible('[value="testing-value"]')
                    // autofocus()
                    ->assertFocused('#testing-focus')
                    //asHtml() don't see in create view
                    ->assertSourceMissing($this->asHtml);
        });
    }
}
