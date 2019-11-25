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
                // Index
                ->visit('dashboard/' . $this->field)
                ->assertSeeIn(
                    '#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(5) > a',
                    $this->user->profile->profile_avatar
                )
                ->assertSourceHas('<a href="/dashboard/profiles/' . $this->user->profile->id . '" class="show-link"> ' . $this->user->profile->profile_avatar . '</a>')
                ->assertSeeIn(
                    '#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(6) > a',
                    $this->user->profile->profile_address
                )
                ->assertSourceHas('<a href="/dashboard/profiles/' . $this->user->profile->id . '" class="show-link"> ' . $this->user->profile->profile_address . '</a>')
            // Create
            ->visit('dashboard/' . $this->field . '/create')
            // Not see no editable field
            ->assertMissing('#profile_no_editable')
            // Assert see info
            ->assertSeeIn('@info-profile_address','Notice!!! This will create a new row in the database: profiles')
            ->assertSeeIn('@info-profile_avatar','Notice!!! This will create a new row in the database: profiles')
            // Edit
            ->visit('dashboard/' . $this->field . '/1/edit')
            // Not see no editable field
            ->assertMissing('#profile_no_editable')
            // Assert select populate
            ->assertSelectHasOptions('@profile_avatar', \App\Profile::pluck('profile_avatar')->all())
            // Assert custom populate
            ->assertSelectHasOptions('@datalist-info-profile_address', \App\Profile::where('user_id', '>', 10)->pluck('profile_address')->all());
        });
    }

    /**
     * Test relationship hasOne store
     *
     * dusk --filter test_relationship_hasOne_store
     */
    public function test_relationship_hasOne_store()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                // Index
                ->visit('dashboard/' . $this->field . '/create')
                ->type('@dusk-name', 'Damian Aguilar')
                ->type('@dusk-email', 'damian.aguilarm@gmail.com')
                ->type('@dusk-password', '12345678')
                ->type('@profile_avatar', 'http://www.my-image.com/?1002')
                ->type('@profile_address', 'C/ Gran Via 42')
                ->press('@button-action-create')
                ->waitForText('The resource has been successfully created');

            $this->assertDatabaseHas('users', [
                    'id' => 2,
                    'name' => 'Damian Aguilar',
                    'email' => 'damian.aguilarm@gmail.com',
                ]);

            $this->assertDatabaseHas('profiles', [
                    'user_id' => 2,
                    'profile_avatar' => 'http://www.my-image.com/?1002',
                    'profile_address' => 'C/ Gran Via 42',
                ]);
        });
    }
}
