<?php

namespace Tests\Browser\Fields;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// dusk --filter TextTest
class TextTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create();
    }

    /**
     * Login test
     *
     * dusk --filter test_visibility
     * @return void
     */
    public function test_visibility()
    {
        $this->browse(function (Browser $browser) {
            // Index visibility
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/_fieldtexts')
                ->assertSee(parent::visibilityText('Except on forms', 'index'))
                ->assertSee(parent::visibilityText('Hide when creating', 'index'))
                ->assertSee(parent::visibilityText('Hide when editing', 'index'))
                ->assertDontSee(parent::visibilityText('Hide from index', 'index'))
                ->assertDontSee(parent::visibilityText('Hide-from index', 'index'))
                ->assertSee(parent::visibilityText('Hide from show', 'index'))
                ->assertDontSee(parent::visibilityText('Only on forms', 'index'))
                ->assertSee(parent::visibilityText('Only on index', 'index'))
                ->assertDontSee(parent::visibilityText('Only on show', 'index'))
                ->assertSee(parent::visibilityText('Visible-on index', 'index'));

            // SHOW visibility
            $browser
                ->visit('dashboard/_fieldtexts/' . $this->user->id)
                ->assertSee(parent::visibilityText('Except on forms', 'show'))
                ->assertSee(parent::visibilityText('Hide when creating', 'show'))
                ->assertSee(parent::visibilityText('Hide when editing', 'show'))
                ->assertSee(parent::visibilityText('Hide from index', 'show'))
                ->assertSee(parent::visibilityText('Hide-From index', 'show'))
                ->assertDontSee(parent::visibilityText('Hide from show', 'show'))
                ->assertDontSee(parent::visibilityText('Only on forms', 'show'))
                ->assertDontSee(parent::visibilityText('Only on index', 'show'))
                ->assertSee(parent::visibilityText('Only on show', 'show'))
                ->assertDontSee(parent::visibilityText('Visible-On index', 'show'));

                // Edit visibility
                $browser
                    ->visit('dashboard/_fieldtexts/' . $this->user->id . '/edit')
                    ->assertDontSee(parent::visibilityText('Except on forms', 'show'))
                    ->assertSee(parent::visibilityText('Hide when creating', 'show'))
                    ->assertDontSee(parent::visibilityText('Hide when editing', 'show'))
                    ->assertSee(parent::visibilityText('Hide from index', 'show'))
                    ->assertSee(parent::visibilityText('Hide-From index', 'show'))
                    ->assertSee(parent::visibilityText('Hide from show', 'show'))
                    ->assertSee(parent::visibilityText('Only on forms', 'show'))
                    ->assertDontSee(parent::visibilityText('Only on index', 'show'))
                    ->assertDontSee(parent::visibilityText('Only on show', 'show'))
                    ->assertDontSee(parent::visibilityText('Visible-On index', 'show'));

            // Create visibility
            $browser
                ->visit('dashboard/_fieldtexts/create')
                ->assertDontSee(parent::visibilityText('Except on forms', 'create'))
                ->assertDontSee(parent::visibilityText('Hide when creating', 'create'))
                ->assertSee(parent::visibilityText('Hide when editing', 'create'))
                ->assertSee(parent::visibilityText('Hide from index', 'create'))
                ->assertSee(parent::visibilityText('Hide-From index', 'create'))
                ->assertSee(parent::visibilityText('Hide from show', 'create'))
                ->assertSee(parent::visibilityText('Only on forms', 'create'))
                ->assertDontSee(parent::visibilityText('Only on index', 'create'))
                ->assertDontSee(parent::visibilityText('Only on show', 'create'))
                ->assertDontSee(parent::visibilityText('Visible-On index', 'create'));
        });
    }
}
