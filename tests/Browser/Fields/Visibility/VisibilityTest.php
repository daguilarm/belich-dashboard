<?php

namespace Tests\Browser\Fields\Visibility;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\Browser\Fields\Visibility\VisibilityHelper;
use Tests\DuskTestCase;

// dusk --filter VisibilityTest
class VisibilityTest extends DuskTestCase
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
     * Visibility test
     *
     * dusk --filter test_fields_visibility
     * @return void
     */
    public function test_fields_visibility()
    {
        //Visibility tests
        $this->browse(function (Browser $browser): void {
            // Authenticate
            $browser->loginAs($this->user);

            //Visibility assertions
            collect($this->fields)->map(function ($except, $field) use ($browser): void {
                $this->assertVisibility(
                    $browser,
                    $this->user,
                    $this->setField($field)
                );
            });
        });
    }
}
