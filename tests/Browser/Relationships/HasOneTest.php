<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter HasOneTest
class HasOneTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class, 3)->create();
        $this->field = $this->setRelationship('hasOne');
    }

    /**
     * Test relationship hasOne
     *
     * dusk --filter test_relationship_hasOne
     */
    public function test_relationship_hasOne()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field);
        });
    }

    /**
     * Test select option values
     *
     * dusk --filter test_select_values
     */
    public function test_select_values()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user);
            // Create
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                // Testing DB values
                ->assertSelectHasOptions('#testing_db', User::pluck('id')->toArray())
                // Testing default value
                ->assertSelected('#testing_default', 2)
                ->assertNotSelected('#testing_default', 1);
            // Edit
            $browser
                ->visit('dashboard/' . $this->field . '/1/edit')
                ->assertSelected('#testing_db', 1)
                ->assertSelected('#testing_labels', 1);
        });
    }
}
