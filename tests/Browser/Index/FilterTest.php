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

// dusk --filter FilterTest
class FilterTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->field = 'users';
        $this->user = factory(User::class)->create([
            'id' => 1,
            'role' => 'admin',
            'name' => 'Belich-01',
            'created_at' => '2019-12-01',
        ]);
        // Filter users
        factory(User::class)->create([
            'id' => 11,
            'role' => 'user',
            'name' => 'Belich-11',
            'created_at' => '2019-12-11',
        ]);
        factory(User::class)->create([
            'id' => 21,
            'role' => 'user',
            'name' => 'Belich-21',
            'created_at' => '2019-12-21',
        ]);
        factory(User::class)->create([
            'id' => 31,
            'role' => 'manager',
            'name' => 'Belich-31',
            'created_at' => '2019-12-31',
        ]);
        factory(User::class)->create([
            'id' => 41,
            'role' => 'manager',
            'name' => 'Belich-41',
            'created_at' => '2020-01-01',
        ]);
        factory(User::class)->create([
            'id' => 51,
            'role' => 'admin',
            'name' => 'aBelich-51',
            'created_at' => '2020-02-01',
        ]);
    }

    /**
     * Filter test
     *
     * dusk --filter test_filter_equal
     * @return void
     */
    public function test_filter_equal()
    {
        $this->browse(function (Browser $browser) {
            //Test filter equal
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->click('@button-options-filters')
                ->select('@dusk-filter-role', 'admin')
                ->click('@dusk-button-filter')
                ->pause(500)
                ->assertSee('Belich-01')
                ->assertSee('aBelich-51')
                ->assertDontSee('Belich-11')
                ->assertDontSee('Belich-21')
                ->assertDontSee('Belich-31')
                ->assertDontSee('Belich-41')
                ->select('@dusk-filter-role', 'manager')
                ->click('@dusk-button-filter')
                ->pause(500)
                ->assertSee('Belich-31')
                ->assertSee('Belich-41')
                ->assertDontSee('Belich-01')
                ->assertDontSee('aBelich-51')
                ->assertDontSee('Belich-11')
                ->assertDontSee('Belich-21');
        });
    }

    /**
     * Filter test
     *
     * dusk --filter test_filter_interval
     * @return void
     */
    public function test_filter_interval()
    {
        $this->browse(function (Browser $browser) {
            //Test filter equal
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->click('@button-options-filters')
                ->select('@dusk-filter-id', '0-10')
                ->click('@dusk-button-filter')
                ->pause(500)
                ->assertSee('Belich-01')
                ->assertDontSee('Belich-11')
                ->assertDontSee('Belich-21')
                ->assertDontSee('Belich-31')
                ->assertDontSee('Belich-41')
                ->assertDontSee('aBelich-51')
                ->select('@dusk-filter-id', '31-50')
                ->click('@dusk-button-filter')
                ->pause(500)
                ->assertSee('Belich-31')
                ->assertSee('Belich-41')
                ->assertDontSee('Belich-01')
                ->assertDontSee('Belich-11')
                ->assertDontSee('Belich-21')
                ->assertDontSee('aBelich-51');
        });
    }

    /**
     * Filter test
     *
     * dusk --filter test_filter_like
     * @return void
     */
    public function test_filter_like()
    {
        $this->browse(function (Browser $browser) {
            //Test filter equal
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->click('@button-options-filters')
                ->select('@dusk-filter-name', 'a%')
                ->click('@dusk-button-filter')
                ->pause(500)
                ->assertSee('aBelich-51')
                ->assertDontSee('Belich-01')
                ->assertDontSee('Belich-11')
                ->assertDontSee('Belich-21')
                ->assertDontSee('Belich-31')
                ->assertDontSee('Belich-41')
                ->select('@dusk-filter-name', 'd%')
                ->click('@dusk-button-filter')
                ->pause(500)
                ->assertDontSee('aBelich-51')
                ->assertDontSee('Belich-01')
                ->assertDontSee('Belich-11')
                ->assertDontSee('Belich-21')
                ->assertDontSee('Belich-31')
                ->assertDontSee('Belich-41');
        });
    }

    /**
     * Filter test
     *
     * dusk --filter test_filter_date
     * @return void
     */
    public function test_filter_date()
    {
        $this->browse(function (Browser $browser) {
            //Test filter equal
            $browser
                ->loginAs($this->user)
                ->visit('/dashboard/' . $this->field)
                ->click('@button-options-filters')
                ->type('@dusk-filter-created_at-start', '01/12/2019')
                ->type('@dusk-filter-created_at-end', '11/12/2019')
                ->click('@dusk-button-filter')
                ->pause(500)
                ->assertSee('Belich-01')
                ->assertSee('Belich-11')
                ->assertDontSee('Belich-21')
                ->assertDontSee('Belich-31')
                ->assertDontSee('Belich-41')
                ->assertDontSee('aBelich-51')
                ->type('@dusk-filter-created_at-start', '31/12/2019')
                ->clear('@dusk-filter-created_at-end')
                ->click('@dusk-button-filter')
                ->pause(500)
                ->assertDontSee('Belich-01')
                ->assertDontSee('Belich-11')
                ->assertDontSee('Belich-21')
                ->assertSee('Belich-31')
                ->assertSee('Belich-41')
                ->assertSee('aBelich-51');
        });
    }
}
