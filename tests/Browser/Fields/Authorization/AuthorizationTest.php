<?php

namespace Tests\Browser\Fields\Visibility;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\Browser\Fields\Visibility\VisibilityHelper;
use Tests\DuskTestCase;

// dusk --filter AuthorizationTest
class AuthorizationTest extends DuskTestCase
{
    use DatabaseMigrations, Setup, VisibilityHelper;

    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->test = factory(Test::class)->create();
        $this->user = factory(User::class)->create();
    }

    /**
     * Authorization test
     *
     * dusk --filter test_fields_auth
     * @return void
     */
    public function test_fields_auth()
    {
        //Authorization tests
        $this->browse(function (Browser $browser): void {
            // Authenticate
            $browser->loginAs($this->user);

            //Authorization assertions
            collect($this->fields)->map(function ($except, $field) use ($browser): void {
                $browser
                    ->visit('dashboard/' . $this->setField($field) . '/create')
                    ->assertPresent($this->exception($field)->first())
                    ->assertMissing($this->exception($field)->last());
            });
        });
    }

    private function exception(string $field)
    {
        // Filter for autocomplete
        if($field === 'autocompletes') {
            return collect(['#input_4fce0bb20fdf6f5d56f900d7782a5d90', '#input_a6985d861342a82d2d8f09605e463841']);
        }

        return collect(['#testing_can_see', '#testing_cannot_see']);
    }
}
