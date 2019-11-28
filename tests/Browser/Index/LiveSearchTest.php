<?php

namespace Tests\Browser\Index;

use App\Test;
use App\User;
use Daguilarm\Belich\Facades\Helper;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter LiveSearchTest
class LiveSearchTest extends DuskTestCase
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
            'test_name' => 'damian antonio',
        ]);
        $this->field = $this->setField('texts');
        factory(Test::class, 99)->create();
    }

    /**
     * Login test
     *
     * dusk --filter test_liveSearch
     * @return void
     */
    public function test_liveSearch()
    {
        $this->browse(function (Browser $browser) {
            //Test live search
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->type('#search-797a976bf15400073ad793315d544002', 'damian antonio')
                ->pause(400)
                ->assertSeeIn('table.index-table > tbody > tr:nth-child(1) > td:nth-child(2)', 'damian antonio');

            // Assert there is only one result
            $tableRows = count($browser->driver->findElements(WebDriverBy::cssSelector('table.index-table > tbody > tr')));
            $this->assertEquals($tableRows, 1);

            // Reset search
            $browser
                ->assertSourceHas('<span class="" id="icon-search-reset-797a976bf15400073ad793315d544002"> <i class="fas fa-times-circle cursor-pointer text-gray-500" onclick="resetSearch(\'797a976bf15400073ad793315d544002\')"></i> </span>')
                ->click('#icon-search-reset-797a976bf15400073ad793315d544002')
                ->assertSourceMissing('<span class="" id="icon-search-reset-797a976bf15400073ad793315d544002"> <i class="fas fa-times-circle cursor-pointer text-gray-500" onclick="resetSearch(\'797a976bf15400073ad793315d544002\')"></i> </span>');
            });
    }
}
