<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter PatternTest
class PatternTest extends DuskTestCase
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
        $this->field = $this->setField('patternactions');
    }

    /**
     * Test pattern fields
     *
     * dusk --filter test_pattern_field
     */
    public function test_pattern_field()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                // Testing date
                ->type('#test_mask_date', 'john212')
                ->assertInputValueIsNot('#test_mask_date', 'john212')
                ->clear('#test_mask_date')
                ->type('#test_mask_date', '10112019')
                ->assertInputValue('#test_mask_date', '10/11/2019')
                // Testing telephone
                ->type('#test_mask_telephone', 'john212')
                ->assertInputValueIsNot('#test_mask_telephone', 'john212')
                ->clear('#test_mask_telephone')
                ->type('#test_mask_telephone', '9112349786')
                ->assertInputValue('#test_mask_telephone', '(91) 1234-9786')
                // Testing spanish ID
                ->type('#test_mask_id', 'john212')
                ->assertInputValueIsNot('#test_mask_id', 'john212')
                ->clear('#test_mask_id')
                ->type('#test_mask_id', '123456789a')
                ->assertInputValue('#test_mask_id', '123456789-a')
                // Testing serial number
                ->type('#test_mask_serial', 'john212')
                ->assertInputValueIsNot('#test_mask_serial', 'john212')
                ->clear('#test_mask_serial')
                ->type('#test_mask_serial', '1a34m6790a')
                ->assertInputValue('#test_mask_serial', '1a-34-m679-0a');
        });
    }
}
