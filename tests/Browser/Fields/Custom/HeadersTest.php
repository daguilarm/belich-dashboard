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

    /**
     * Testing customization
     *
     * dusk --filter test_headers_customization
     * @return void
     */
    public function test_headers_customization()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field .'/create')
                    ->assertSourceHas('<div class="w-full items-center py-5 px-6 font-bold text-gray-600 bg-gray-300"> Header 1 </div>')
                    ->assertSourceHas('<h1 class="bg-gray-800 text-white p-5"><i class="fas fa-envelope-open-text icon"></i> Header 2</h1>')
                    ->assertSourceHas('<div class="w-full items-center py-5 px-6 font-bold text-green-500 bg-green-200"> Header 3 </div>');
        });
    }
}
