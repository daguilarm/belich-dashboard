<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter HeadersTest
class HeadersTest extends DuskTestCase
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
        $this->field = $this->setField('headers');
    }

    /**
     * Testing visibility: only on forms
     *
     * dusk --filter test_headers_visibility
     * @return void
     */
    public function test_headers_visibility()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                    ->assertDontSee('Header 1')
                    ->assertDontSee('Header 2')
                    ->assertDontSee('Header 3')
                ->visit('dashboard/' . $this->field . '/1')
                    ->assertDontSee('Header 1')
                    ->assertDontSee('Header 2')
                    ->assertDontSee('Header 3')
                ->visit('dashboard/' . $this->field .'/create')
                    ->assertSee('Header 1')
                    ->assertSee('Header 2')
                    ->assertSee('Header 3')
                ->visit('dashboard/' . $this->field . '/1/edit')
                    ->assertSee('Header 1')
                    ->assertSee('Header 2')
                    ->assertSee('Header 3');
        });
    }
}
