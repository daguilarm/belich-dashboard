<?php

namespace Tests\Unit;

use Daguilarm\Belich\Facades\Helper;
use Tests\TestCase;

//test --filter ResourcesTest
class StringsTest extends TestCase
{
    /** Test */
    //test --filter test_string_plural_lower
    public function test_string_plural_lower()
    {
        $actual = Helper::stringPluralLower('USER');
        $expected = 'users';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    //test --filter test_string_plural_upper
    public function test_string_plural_upper()
    {
        $actual = Helper::stringPluralUpper('user');
        $expected = 'Users';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    //test --filter test_string_singular_upper
    public function test_string_singular_upper()
    {
        $actual = Helper::stringSingularUpper('users');
        $expected = 'User';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    //test --filter test_string_to_kebab
    public function test_string_to_kebab()
    {
        $actual = Helper::stringTokebab('user stats');
        $expected = 'user-stats';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    //test --filter test_empty_results
    public function test_empty_results()
    {
        $actual = Helper::emptyResults();
        $expected = '—';
        $this->assertEquals($expected, $actual);
    }
}
