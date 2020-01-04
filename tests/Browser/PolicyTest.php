<?php

namespace Tests\Browser;

use App\Test;
use App\User;
use Daguilarm\Belich\Facades\Helper;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter PolicyTest
class PolicyTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $card;
    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create(['id' => 1]); factory(User::class, 20)->create();
        $this->test = factory(Test::class, 15)->create();
        $this->field = 'policies';
    }

    /**
     * Testing policies visibility
     *
     * dusk --filter test_policies_visibility
     * @return void
     */
    public function test_policies_visibility()
    {
        $this->browse(function (Browser $browser) {
            // Dashboard
            $browser
                ->loginAs($this->user->find(1))
                ->visit('/dashboard/' . $this->field)
                ->assertSourceHas('https://belich-dashboard.test/dashboard/policies/1')
                ->assertSourceHas('https://belich-dashboard.test/dashboard/policies/1/edit')
                ->assertSourceMissing('https://belich-dashboard.test/dashboard/policies/2')
                ->assertSourceMissing('https://belich-dashboard.test/dashboard/policies/2/edit')
                ->assertSourceMissing('https://belich-dashboard.test/dashboard/policies/3')
                ->assertSourceMissing('https://belich-dashboard.test/dashboard/policies/3/edit');
        });
    }

    /**
     * Testing policies access
     *
     * dusk --filter test_policies_access
     * @return void
     */
    public function test_policies_access()
    {
        $this->browse(function (Browser $browser) {
            // Dashboard
            $browser
                ->loginAs($this->user->find(1))
                ->visit('/dashboard/' . $this->field . '/1')
                ->assertDontSee('403')
                ->visit('/dashboard/' . $this->field . '/2')
                ->assertSee('403')
                ->visit('/dashboard/' . $this->field . '/1/edit')
                ->assertDontSee('403')
                ->visit('/dashboard/' . $this->field . '/2/edit')
                ->assertSee('403')
                ->visit('/dashboard/' . $this->field . '/create')
                ->assertSee('403');
        });
    }
}
