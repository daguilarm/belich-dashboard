<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter RangeTest
class RangeTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 30)->create();
        $this->field = $this->setField('ranges');
    }

    /**
     * Testing range
     *
     * dusk --filter test_range_field
     * @return void
     */
    public function test_range_field()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input class="mr-3" type="range" dusk="dusk-test_range" id="test_range" name="test_name" max="100" min="1" step="10" list="datalist_test_range">')
                ->assertSourceHas('<input class="mr-3" type="range" dusk="dusk-test_range_options" id="test_range_options" name="test_name" step="10" list="datalist_test_range_options"> <datalist id="datalist_test_range_options"> <option>0</option> <option>10</option> <option>20</option> <option>30</option> <option>40</option> <option>50</option> <option>60</option> <option>70</option> <option>80</option> <option>90</option> <option>100</option> </datalist>');
        });
    }
}
