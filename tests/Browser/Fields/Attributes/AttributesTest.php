<?php

namespace Tests\Browser\Fields\Visibility;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Attributes\AttributesHelper;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter AttributesTest
class AttributesTest extends DuskTestCase
{
    use DatabaseMigrations, Setup, AttributesHelper;

    protected $asHtml;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->asHtml = '<h1 class="text-red-500">Hello world</h1>';
        $this->test = factory(Test::class)->create();
        $this->user = factory(User::class)->create();
    }

    /**
     * Attributes test
     *
     * dusk --filter test_fields_attributes
     * @return void
     */
    public function test_fields_attributes()
    {
        //Visibility tests
        $this->browse(function (Browser $browser): void {
            // Authenticate
            $browser->loginAs($this->user);

            //Visibility assertions
            collect($this->fields)->map(function ($except, $field) use ($browser): void {
                //No tests
                if ($except === 'all') {
                    return;
                }

                $this->assertAttributes(
                    $browser,
                    $this->user,
                    $this->test,
                    $field,
                    $this->asHtml,
                    $except
                );
            });
        });
    }
}
