<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter PanelsTest
class PanelsTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->test = factory(Test::class)->create();
        $this->field = '_panels';
    }

    /**
     * Testing panel visibility
     *
     * dusk --filter test_panel_visibility
     * @return void
     */
    public function test_panel_visibility()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                    ->assertDontSee('Panel 1')
                    ->assertDontSee('Panel 2')
                ->visit('dashboard/' . $this->field . '/1')
                    ->assertSee('Panel 1')
                    ->assertSee('Panel 2')
                ->visit('dashboard/' . $this->field .'/create')
                    ->assertSee('Panel 1')
                    ->assertSee('Panel 2')
                ->visit('dashboard/' . $this->field . '/1/edit')
                    ->assertSee('Panel 1')
                    ->assertSee('Panel 2');
        });
    }

    /**
     * Testing customization
     *
     * dusk --filter test_panels_customization
     * @return void
     */
    public function test_panels_customization()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field .'/create')
                    ->assertSourceHas('<div class="w-full items-center py-5 px-6 font-bold text-white bg-red-500"> Panel 1 </div>')
                    ->assertSourceHas('<div class="w-full items-center py-5 px-6 font-bold text-gray-600 bg-gray-300"> Panel 2 </div>');
        });
    }
}
