<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter EmailTest
class EmailTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 30)->create();
        $this->field = $this->setField('emails');
    }

    /**
     * Testing email multiple
     *
     * dusk --filter test_email_multiple
     * @return void
     */
    public function test_email_multiple()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input class="mr-3" type="email" value="" dusk="dusk-test_email" id="test_email" name="test_email">')
                ->assertSourceMissing('<input class="mr-3" type="email" value="" dusk="dusk-test_email" id="test_email" name="test_email" multiple="">')
                ->assertSourceHas('<input class="mr-3" type="email" value="" dusk="dusk-test_email_multiple" id="test_email_multiple" name="test_email" multiple="">');
        });
    }
}
