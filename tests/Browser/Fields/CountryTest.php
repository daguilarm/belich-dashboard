<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter CountryTest
class CountryTest extends DuskTestCase
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
        $this->field = '_fieldcountries';
        $this->asHtml = '<h1 class="text-red-500">Hello world</h1>';
    }

    /**
     * Visibility test
     *
     * dusk --filter test_countries_visibility
     * @return void
     */
    public function test_countries_visibility()
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
     * dusk --filter test_countries_attributes
     * @return void
     */
    public function test_countries_attributes()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                //App\Providers\DuskServiceProvider
                ->exceptAttributes(['dusk', 'autofocus', 'prefix', 'display'])
                ->assertAttributes(
                    $this->user,
                    $this->test,
                    $this->field,
                    $this->asHtml
                );
        });
    }
}
