<?php

namespace Tests\Unit;

use Tests\TestCase;

class StringsTest extends TestCase
{
    /** Test */
    public function test_string_plural_lower()
    {
        $actual = stringPluralLower('USER');
        $expected = 'users';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_string_plural_upper()
    {
        $actual = stringPluralUpper('user');
        $expected = 'Users';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_string_singular_upper()
    {
        $actual = stringSingularUpper('users');
        $expected = 'User';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_string_to_kebab()
    {
        $actual = stringTokebab('user stats');
        $expected = 'user-stats';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_empty_results()
    {
        $actual = emptyResults();
        $expected = '—';
        $this->assertEquals($expected, $actual);
    }
}
