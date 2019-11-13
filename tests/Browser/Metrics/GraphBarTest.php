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

// dusk --filter GraphBarTest
class GraphBarTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 15)->create();
        $this->field = 'users';
    }

    /**
     * Table create buttons
     *
     * dusk --filter test_graph_bar
     * @return void
     */
    public function test_graph_bar()
    {
        $this->browse(function (Browser $browser) {
            // Create buttons
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field);
        });
    }
}
