<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Attributes\AttributesHelper;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter IdTest
class IdTest extends DuskTestCase
{
    use AttributesHelper, DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->test = factory(Test::class)->create();
        $this->field = $this->setField('ids');
    }

    /**
     * Testing visibility: except on forms
     *
     * dusk --filter test_id_visibility
     * @return void
     */
    public function test_id_visibility()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                    ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(2)', 1)
                ->visit('dashboard/' . $this->field . '/1')
                    ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(4)', 1);
        });
    }

    /**
     * Testing attributes
     *
     * dusk --filter test_id_attributes
     * @return void
     */
    public function test_id_attributes()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                    // Assert resolveUsing is not working
                    ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(3)', '1')
                    // Assert displayUsing is not working
                    ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(4)', '1');
        });
    }
}
