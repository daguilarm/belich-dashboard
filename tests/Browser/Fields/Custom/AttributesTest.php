<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter AttributesTest
class AttributesTest extends DuskTestCase
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
        $this->field = $this->setField('attributes');
    }

    /**
     * Testing email multiple
     *
     * dusk --filter test_email_multiple_attribute
     * @return void
     */
    public function test_email_multiple_attribute()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input class="mr-3" type="text" dusk="testing-text" id="test_string" name="test_string" placeholder="testing placeholder in text" pattern="[a-z]{1,15}">')
                ->assertSourceHas('<input class="mr-3" type="email" dusk="testing-email" id="test_email" name="test_email" placeholder="testing placeholder in email" pattern="[a-z]{1,15}">')
                ->assertSourceHas('<select class="block px-4 py-2 pr-8" dusk="testing-select" id="test_string" name="test_string" placeholder="testing placeholder in select" pattern="[a-z]{1,15}"> </select>');
        });
    }
}
