<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter ImageTest
class ImageTest extends DuskTestCase
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
        $this->field = $this->setField('images');
    }

    /**
     * Test image render
     *
     * dusk --filter test_image_render
     * @return void
     */
    public function test_image_render()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field)
                // Render image
                ->assertSourceHas('<img src="' . $this->test->test_file . '" class="block h-10 rounded-full shadow-md">')
                // Download image
                ->assertSourceHas('<a href="' . $this->test->test_file . '" target="_blank" dusk="downloable-file"><i class="fas fa-download icon"></i></a>')
                // No render, just url link
                ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(3)', $this->test->test_file);
        });
    }
}
