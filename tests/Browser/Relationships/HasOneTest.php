<?php

namespace Tests\Browser\Fields\Relationship;

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
}
