<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter NumberTest
class NumberTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create();
        $this->field = $this->setField('numbers');
    }

    /**
     * Test number attributes
     *
     * dusk --filter test_number_attributes
     * @return void
     */
    public function test_number_attributes()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/1/edit');

                $this->assertEquals(1, $browser->attribute('@dusk-test_autofocus', 'min'));
                $this->assertEquals(1, $browser->attribute('@dusk-test_autofocus', 'step'));
                $this->assertEquals(10000, $browser->attribute('@dusk-test_autofocus', 'max'));
        });
    }
}
