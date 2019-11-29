<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter ConditionalTest
class ConditionalTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create([
            'test_boolean' => true,
            'test_status' => false,
        ]);
        $this->field = '_conditionals';
    }

    /**
     * Conditional visibility test
     *
     * dusk --filter test_conditional_visibility
     * @return void
     */
    public function test_conditional_visibility()
    {
        $this->browse(function (Browser $browser) {
            // Create
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                    // See email
                    ->assertMissing('@dusk-test_email')
                    ->assertPresent('@dusk-test_email')
                    ->click('@label-test_boolean')
                    ->waitFor('@dusk-test_email')
                    ->assertVisible('@dusk-test_email')
                    // See address
                    ->assertMissing('@dusk-test_address')
                    ->assertPresent('@dusk-test_address')
                    ->select('@dusk-test_status', 1)
                    ->waitFor('@dusk-test_address')
                    ->assertVisible('@dusk-test_address')
                    // Hide email
                    ->click('@label-test_boolean')
                    ->assertMissing('@dusk-test_email')
                    ->assertVisible('@dusk-test_address')
                    // Hide address
                    ->select('@dusk-test_status', 0)
                    ->assertMissing('@dusk-test_address')
                    ->assertMissing('@dusk-test_email');
        });
    }
}
