<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter TabTest
class TabTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 10)->create();
        $this->field = $this->setField('tabs');
    }

    /**
     * Test Year
     *
     * dusk --filter test_field_year
     */
    public function test_field_year()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                // Only numerics: error
                ->type('#test_autofocus', 'lorem')
                ->assertInputValue('#test_autofocus', '')
                // Only numerics: success
                ->type('#test_autofocus', '1999')
                ->assertInputValue('#test_autofocus', '1999');
        });
    }
}
