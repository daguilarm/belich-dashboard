<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter TextAreaTest
class TextAreaTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $text;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create([
            'test_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.',
        ]);
        $this->field = $this->setField('textareaactions');
        $this->text = 'Lorem ipsum dolor sit ...';
    }

    /**
     * Test textArea fullText
     *
     * dusk --filter test_textarea_fullText
     */
    public function test_textarea_fullText()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                // Index
                ->visit('dashboard/' . $this->field)
                ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(2)', $this->text)
                ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(3)', $this->test->test_description)
                ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(4)', $this->text)
                ->assertSeeIn('#belich-index-table > tbody > tr:nth-child(1) > td:nth-child(5)', $this->test->test_description)
                // Show
                ->visit('dashboard/' . $this->field . '/1')
                ->assertSeeIn('#app > div > div.form-container > div:nth-child(1) > div.w-2\/3.my-auto', $this->text)
                ->assertSeeIn('#app > div > div.form-container > div:nth-child(2) > div.w-2\/3.my-auto', $this->test->test_description)
                ->assertSeeIn('#app > div > div.form-container > div:nth-child(3) > div.w-2\/3.my-auto', $this->test->test_description)
                ->assertSeeIn('#app > div > div.form-container > div:nth-child(4) > div.w-2\/3.my-auto', $this->text);
        });
    }

    /**
     * Test textArea attributes
     *
     * dusk --filter test_textArea_attributes
     */
    public function test_textArea_attributes()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create');

            $this->assertEquals(100, $browser->attribute('#full_attributes', 'maxlength'));
            $this->assertEquals(10, $browser->attribute('#full_attributes', 'rows'));
        });
    }

    /**
     * Test textArea countdown
     *
     * dusk --filter test_textArea_countdown
     */
    public function test_textArea_countdown()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->type('#full_attributes', ' lorem ipsum')
                ->assertSourceHas('<p id="chars-full_attributes" class="italic mt-2">Characters left: <b>88</b></p>')
                ->clear('#full_attributes')
                ->type('#full_attributes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.')
                ->assertSourceHas('<p id="chars-full_attributes" class="italic mt-2">Characters left: <b>0</b></p>')
                ->assertValue('#full_attributes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et do');
        });
    }
}
