<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter CurrencyTest
class CurrencyTest extends DuskTestCase
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
            'test_decimal' => '20655.74',
        ]);
        $this->field = $this->setField('currencies');
    }

    /**
     * Test currency fields
     *
     * dusk --filter test_currency_field
     */
    public function test_currency_field()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                // Index
                ->visit('dashboard/' . $this->field)
                ->assertSee('20.655,74 DKK')
                ->assertSee('20.655,74 €')
                ->assertSee('20.655,74 US$');
        });
    }
}
