<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter BooleanTest
class BooleanTest extends DuskTestCase
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
        $this->field = '_fieldbooleans';
    }

    /**
     * Visibility test
     *
     * dusk --filter test_boolean_visibility
     * @return void
     */
    public function test_boolean_visibility()
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
     * dusk --filter test_boolean_attributes
     * @return void
     */
    public function test_boolean_attributes()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                //App\Providers\DuskServiceProvider
                ->assertAttributes($this->user, $this->test, $this->field, null);
        });
    }

    /**
     * Authorization test
     *
     * dusk --filter test_boolean_authorization
     * @return void
     */
    public function test_boolean_authorization()
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
