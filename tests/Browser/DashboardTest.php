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
                ->assertVisible('#tool-calendar')
                ->assertVisible('#tool-model');
        });
    }
}
