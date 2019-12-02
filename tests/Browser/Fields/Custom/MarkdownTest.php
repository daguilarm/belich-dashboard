<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Daguilarm\Belich\Facades\Helper;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Attributes\AttributesHelper;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter MarkdownTest
class MarkdownTest extends DuskTestCase
{
    use AttributesHelper, DatabaseMigrations, Setup;

    protected $baseField;
    protected $except;
    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->asHtml = '<h1 class="text-red-500">Hello world</h1>';
        $this->baseField = 'markdowns';
        $this->except = ['defaultValue', 'prefix', 'resolve', 'display'];
        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create();
        $this->field = $this->setField($this->baseField);
        $this->fieldAction = $this->setField('markdownactions');
    }

    /**
     * Testing markdown visibility
     *
     * dusk --filter test_markdown_visibility
     * @return void
     */
    public function test_markdown_visibility()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                // INDEX visibility
                ->visit('dashboard/' . $this->field )
                    ->assertDontSee(strtoupper('Hide when creating'))
                    ->assertDontSee(strtoupper('Hide when editing'))
                    ->assertDontSee(strtoupper('Hide from index'))
                    ->assertDontSee(strtoupper('Hide-from index'))
                    ->assertDontSee(strtoupper('Hide from show'))
                    ->assertDontSee(strtoupper('Only on forms'))
                    ->assertDontSee(strtoupper('Only on show'))
                    ->assertSee(strtoupper('Visible-on index'))
                    ->assertSee(strtoupper('Except on forms'))
                    ->assertSee(strtoupper('Only on index'))
                // SHOW visibility
                ->visit('dashboard/' . $this->field . '/1')
                    ->assertSee(ucwords('Except on forms'))
                    ->assertSee(ucwords('Hide when creating'))
                    ->assertSee(ucwords('Hide when editing'))
                    ->assertSee(ucwords('Hide from index'))
                    ->assertSee(ucwords('Hide-From index'))
                    ->assertDontSee(ucwords('Hide from show'))
                    ->assertDontSee(ucwords('Only on forms'))
                    ->assertDontSee(ucwords('Only on index'))
                    ->assertSee(ucwords('Only on show'))
                    ->assertDontSee(ucwords('Visible-On index'))
                // EDIT visibility
                ->visit('dashboard/' . $this->field . '/1/edit')
                    ->assertDontSee(ucwords('Except on forms'))
                    ->assertSee(ucwords('Hide when creating'))
                    ->assertDontSee(ucwords('Hide when editing'))
                    ->assertSee(ucwords('Hide from index'))
                    ->assertSee(ucwords('Hide-From index'))
                    ->assertSee(ucwords('Hide from show'))
                    ->assertSee(ucwords('Only on forms'))
                    ->assertDontSee(ucwords('Only on index'))
                    ->assertDontSee(ucwords('Only on show'))
                    ->assertDontSee(ucwords('Visible-On index'))
                // CREATE visibility
                ->visit('dashboard/' . $this->field . '/create')
                    ->assertDontSee(ucwords('Except on forms'))
                    ->assertDontSee(ucwords('Hide when creating'))
                    ->assertSee(ucwords('Hide when editing'))
                    ->assertSee(ucwords('Hide from index'))
                    ->assertSee(ucwords('Hide-From index'))
                    ->assertSee(ucwords('Hide from show'))
                    ->assertSee(ucwords('Only on forms'))
                    ->assertDontSee(ucwords('Only on index'))
                    ->assertDontSee(ucwords('Only on show'))
                    ->assertDontSee(ucwords('Visible-On index'));
        });
    }

    /**
     * Testing Attributes
     *
     * dusk --filter test_markdown_field_dttributes
     * @return void
     */
    public function test_markdown_field_dttributes()
    {
        $this->browse(function (Browser $browser) {
            // Testing Attributes
            $browser->loginAs($this->user);

            //Attributes assertions
            $this->assertAttributes(
                $browser,
                $this->user,
                $this->test,
                $this->baseField,
                $this->asHtml,
                $this->except
            );
        });
    }

    /**
     * Testing markdown actions
     *
     * dusk --filter test_markdown_actions
     * @return void
     */
    public function test_markdown_actions()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->fieldAction . '/1/edit')
                // See short text
                ->assertSourceHas('<textarea class="flex-1 m-1" rows="20" onkeydown="insertTab(this, event);" dusk="dusk-test_markdown" id="markdown_with_preview" name="test_markdown">')
                ->assertSourceHas('<div class="flex-1 overflow-y-auto m-1 rounded p-3 border border-gray-400 bg-gray-100" id="editor-markdown_with_preview">')
                ->assertSourceHas('<textarea class="flex-1 m-1" rows="20" onkeydown="insertTab(this, event);" dusk="dusk-test_markdown" id="test_markdown" name="test_markdown">')
                ->assertSourceMissing('<div class="flex-1 overflow-y-auto m-1 rounded p-3 border border-gray-400 bg-gray-100" id="editor-test_markdown">');
        });
    }
}
