<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter TextTest
class _Test extends DuskTestCase
{
    use DatabaseMigrations;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create();
        $this->field = 'tests';
    }

    /**
     * Create test
     *
     * dusk --filter test_test_create
     * @return void
     */
    public function test_test_create()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input class="testing-class1 testing-class2 mr-3" type="text" value="testing-value" dusk="testing-dusk" id="testing_id" name="testing-name" data-test="testing-data">')
                ->assertSourceHas('<input class="testing-class mr-3" type="text" value="" dusk="dusk-test_string" id="testing_id" name="testing-name" disabled="">')
                ->assertSourceHas('<input class="testing-class mr-3" type="text" value="" dusk="dusk-test_lastname" id="testing_id" name="testing-name" readonly="">');
        });
    }
}
