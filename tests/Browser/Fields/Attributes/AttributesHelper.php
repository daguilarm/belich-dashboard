<?php

namespace Tests\Browser\Fields\Attributes;

use App\Test;
use App\User;
use Laravel\Dusk\Browser;

trait AttributesHelper
{
    /**
     * Attributes test
     *
     * @param Laravel\Dusk\Browser $browser
     * @param App\User $user
     * @param App\Test $test
     * @param string $field
     * @param string $html
     * @param array $except
     *
     * @return Browser
     */
    public function assertAttributes(Browser $browser, User $user, Test $test, string $field, string $html, array $except) : Browser
    {
        $page = $this->setField($field);
        $tableField = $this->tableName[$field] ?? 'test_name';

        //INDEX attributes
        $browser
            ->visit('dashboard/' . $page)
            ->assertPathIs('/dashboard/' . $page);
        $this->assertAttributesIndex($browser, $tableField, $test, $except);

        // EDIT attributes
        $browser
            ->visit('dashboard/' . $page . '/' . $user->id . '/edit')
            ->assertPathIs('/dashboard/' . $page . '/' . $user->id . '/edit');
        $this->assertAttributesEdit($browser, $html, $except);

        // CREATE attributes
        $browser
            ->visit('dashboard/' . $page . '/create')
            ->assertPathIs('/dashboard/' . $page . '/create');
        $this->assertAttributesCreate($browser, $html, $except);

        return $browser;
    }

    /**
     * Attributes assertion in INDEX action
     *
     * @param Laravel\Dusk\Browser $browser
     * @param string $tableField
     * @param App\Test $test
     * @param array $except
     *
     * @return Browser
     */
    private function assertAttributesIndex(Browser $browser, string $tableField, Test $test, array $except): Browser
    {
        $this->assertConstructor($browser, 'prefix', 'assertSee', '***' . $test->{$tableField} . '***', $except);
        $this->assertConstructor($browser, 'resolve', 'assertSee', 'resolved ' . $test->test_email, $except);
        $this->assertConstructor($browser, 'display', 'assertSee', strtoupper($test->test_name), $except);

        return $browser;
    }

    /**
     * Attributes assertion in EDIT action
     *
     * @param Laravel\Dusk\Browser $browser
     * @param string $html
     * @param array $except
     *
     * @return Browser
     */
    private function assertAttributesEdit(Browser $browser, string $html, array $except): Browser
    {
        $this->assertConstructor($browser, 'id', 'assertPresent', '#testing_id', $except);
        $this->assertConstructor($browser, 'dusk', 'assertPresent', '[dusk="testing-dusk"]', $except);
        $this->assertConstructor($browser, 'name', 'assertVisible', '[name="testing-name"]', $except);
        $this->assertConstructor($browser, 'data-test', 'assertVisible', '[data-test="testing-data"]', $except);
        $this->assertConstructor($browser, 'disabled', 'assertVisible', '[disabled]', $except);
        $this->assertConstructor($browser, 'readonly', 'assertVisible', '[readonly]', $except);
        $this->assertConstructor($browser, 'autofocus', 'assertFocused', '@dusk-test_autofocus', $except);

        if(!in_array('asHtml', $except)) {
            //$field->asHtml() don't see in edit view
            $browser->assertSourceMissing($html);
        }
        if(!in_array('addClass', $except)) {
            $browser
                ->assertVisible('.testing-class')
                ->assertVisible('.text-center');
        }

        return $browser;
    }

    /**
     * Attributes assertion in CREATE action
     *
     * @param Laravel\Dusk\Browser $browser
     * @param string $html
     * @param array $except
     *
     * @return Browser
     */
    private function assertAttributesCreate(Browser $browser, string $html, array $except): Browser
    {
        $this->assertConstructor($browser, 'help', 'assertSourceHas', '<div class="font-normal lowercase italic mt-2 uppercase-first-letter">testing help</div>', $except);
        $this->assertConstructor($browser, 'asHtml', 'assertSourceMissing', $html, $except);
        if(!in_array('defaultValue', $except)) {
            $this->assertConstructor($browser, 'defaultValue', 'assertVisible', '[value="testing-value"]', $except);
        }
        return $browser;
    }

    /**
     * Assertion constructor
     *
     * @param Laravel\Dusk\Browser $browser
     * @param string $attribute
     * @param string $assert
     * @param string $selector
     * @param array $except
     *
     * @return Browser
     */
    private function assertConstructor(Browser $browser, $attribute, $assert, $selector, $except)
    {
        if(!in_array($attribute, $except)) {
            return $browser->{$assert}($selector);
        }
    }
}
