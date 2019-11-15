<?php

namespace Tests\Browser\IndexTable;

use App\Test;
use App\User;
use Daguilarm\Belich\Facades\Helper;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter DashboardTest
class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $card;
    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class, 50)->create();
        $this->test = factory(Test::class, 15)->create();

        $this->card[1] = '<div id="tool-calendar" dusk="tool-calendar" class="w-1/3 p-4"> <div class="flex-none text-center"> <div class="block overflow-hidden shadow-md rounded-t"> <div class="bg-blue-500 text-white text-xl py-2"> November </div> <div class="pt-1"> <span class="text-5xl font-bold leading-tight"> 15 </span> </div> <div class="text-center border-white py-2 mb-1"> <span class="text-sm"> Friday </span> </div> </div> </div></div>';
    }

    /**
     * Testing dashboard
     *
     * dusk --filter test_dashboard_page
     * @return void
     */
    public function test_dashboard_page()
    {
        $this->browse(function (Browser $browser) {
            // Dashboard
            $browser
                ->loginAs($this->user->find(1))
                ->visit('/dashboard/')
                ->assertPresent('#tool-calendar')
                ->assertSourceHas($this->card[1])
                ->assertPresent('#tool-model');
        });
    }
}
