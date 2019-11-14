<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter TimeTest
class TimeTest extends DuskTestCase
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
        $this->field = $this->setField('times');
    }

    /**
     * Testing time
     *
     * dusk --filter test_time_field
     * @return void
     */
    public function test_time_field()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input class="mr-3" type="time" value="" dusk="dusk-test_time" id="test_time" name="test_name" max="22:00" min="09:00" step="1">');
        });
    }
}
