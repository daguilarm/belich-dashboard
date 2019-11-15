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

// dusk --filter CardsTest
class CardsTest extends DuskTestCase
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
        $this->field = '_cards';

        $this->card[1] = '<div id="cards-user-card1" class="w-1/3 p-8 overflow-hidden shadow bg-white border border-gray-200"> <h1 class="mb-6">Card 1</h1> <div class="flex flex-wrap justify-center"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </div></div>';
        $this->card[2] = '<div id="cards-user-card2" class="w-2/3 p-8 overflow-hidden shadow bg-white border border-gray-200"> <h1 class="mb-6">Card 2</h1> <div class="flex flex-wrap justify-center"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </div></div>';
        $this->card[3] = '<div id="cards-user-card3" class="w-full p-8 overflow-hidden shadow bg-white border border-gray-200"> <h1 class="mb-6">Card 3</h1> <div class="flex flex-wrap justify-center"> %s </div></div>';
    }

    /**
     * Testing cards
     *
     * dusk --filter test_cards_position
     * @return void
     */
    public function test_cards_position()
    {
        $this->browse(function (Browser $browser) {
            //Set users
            $users = $this->user->pluck('name', 'id')->toArray();
            // Create buttons
            $browser
                ->loginAs($this->user->find(1))
                ->visit('/dashboard/' . $this->field)
                ->assertPathIs('/dashboard/' . $this->field)
                ->assertVisible('#cards-user-card1')
                ->assertSourceHas($this->card[1])
                ->assertVisible('#cards-user-card2')
                ->assertSourceHas($this->card[2])
                ->assertVisible('#cards-user-card3')
                ->assertSourceHas(sprintf($this->card[3], implode(',', $users)));
        });
    }
}
