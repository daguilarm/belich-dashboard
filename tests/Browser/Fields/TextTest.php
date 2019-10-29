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
     * Visibility test
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
                //App\Providers\DuskServiceProvider
                ->assertVisibility($this->user, $this->field);
        });
    }

    /**
     * Attributes test
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
                //App\Providers\DuskServiceProvider
                ->assertAttributes($this->user, $this->test, $this->field, $this->asHtml);
        });
    }

    /**
     * Custom attributes test
     *
     * dusk --filter test_text_custom_attributes
     * @return void
     */
    public function test_text_custom_attributes()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                // addClass
                ->assertVisible('.testing-class')
                // Test autofocus
                ->assertFocused('#test_autofocus');

            // Testing not forms
            $browser
                ->visit('dashboard/' . $this->field)
                // asHtml()
                ->assertSourceHas($this->asHtml)
                // prefix() and suffix()
                ->assertSee('***' . $this->test->test_name . '***')
                //resolveUsing()
                ->assertSee('resolved ' . $this->test->test_email)
                //displayUsing()
                ->assertSee(strtoupper($this->test->test_name));
        });
    }

    /**
     * Authorization test
     *
     * dusk --filter test_text_authorization
     * @return void
     */
    public function test_text_authorization()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertVisible('#testing_can_see')
                ->assertMissing('#testing_cannot_see');
        });
    }
}
