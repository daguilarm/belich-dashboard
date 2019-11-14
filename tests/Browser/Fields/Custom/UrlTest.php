<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter UrlTest
class UrlTest extends DuskTestCase
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
        $this->field = $this->setField('urls');
    }

    /**
     * Testing url
     *
     * dusk --filter test_url_field
     * @return void
     */
    public function test_url_field()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<input class="mr-3" type="url" value="" dusk="dusk-test_url" id="test_url" name="test_url">')
                ->assertSourceHas('<input class="mr-3" type="url" value="http://www.laravel.com" dusk="dusk-test_url_options" id="test_url_options" name="test_url">');
        });
    }
}
