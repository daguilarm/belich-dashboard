<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter ColorTest
class ColorTest extends DuskTestCase
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
            'test_color' => '#e66465',
        ]);
        $this->field = $this->setField('colors');
    }

    /**
     * Testing email multiple
     *
     * dusk --filter test_color_field
     * @return void
     */
    public function test_color_field()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                // Testing index
                ->visit('dashboard/' . $this->field)
                ->assertSourceHas('<div class="w-12 h-2 rounded" style="background-color:#e66465">&nbsp;</div>')
                // Testing show
                ->visit('dashboard/' . $this->field . '/1')
                ->assertSourceHas('<div class="w-12 h-2 rounded" style="background-color:#e66465">&nbsp;</div>')
                // Testing forms
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input class="mr-3" type="color" dusk="dusk-test_color" id="test_color" name="test_color">')
                ->assertSourceHas('<input class="mr-3" type="color" value="#e66465" dusk="dusk-test_color_multiple" id="test_color_multiple" name="test_name">')
                ->assertSourceMissing('<div class="w-12 h-2 rounded" style="background-color:#e66465">&nbsp;</div>');

        });
    }
}
