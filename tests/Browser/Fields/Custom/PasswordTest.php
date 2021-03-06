<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter PasswordTest
class PasswordTest extends DuskTestCase
{
    use DatabaseMigrations, Setup, WithFaker;

    protected $email;
    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create();
        $this->field = $this->setField('passwords');
        $this->email = $this->faker->safeEmail;
    }

    /**
     * Test password visibility
     *
     * dusk --filter test_password_visibility
     * @return void
     */
    public function test_password_visibility()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                // Index visibility
                ->visit('dashboard/' . $this->field)
                    ->assertMissing('#test_password')
                // Show visibility
                ->visit('dashboard/' . $this->field . '/1')
                    ->assertMissing('#test_password')
                // Edit visibility
                ->visit('dashboard/' . $this->field . '/1/edit')
                    ->assertVisible('#test_password')
                // Create visibility
                ->visit('dashboard/' . $this->field . '/create')
                    ->assertVisible('#test_password');
        });
    }

    /**
     * Test password create
     *
     * dusk --filter test_password_create
     * @return void
     */
    public function test_password_create()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertPathIs('/dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input class="mr-3" type="password" dusk="dusk-test_password" id="test_password" name="test_password" autocomplete="on">')
                ->type('#test_name', 'My name')
                ->type('#test_email', $this->email)
                ->type('#test_password', '12345678')
                ->press('#button-form-create')
                ->waitForText('The resource has been successfully created')
                ->assertPathIs('/dashboard/' . $this->field);

            // Assert password
            $this->assertTrue(Hash::check('12345678', Test::latest()->first()->test_password));

            // Assert all the fields has been stored
            $this->assertDatabaseHas('tests', [
                'test_name' => 'My name',
                'test_email' => $this->email,
            ]);
        });
    }
}
