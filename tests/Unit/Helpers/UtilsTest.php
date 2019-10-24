<?php

namespace Tests\Unit;

use Tests\TestCase;

class UtilsTest extends TestCase
{
    /** Test */
    public function test_field_to_array()
    {
        $actual = fieldToArray('1,2,3,4,5,6');
        $expected = [1,2,3,4,5,6];
        $this->assertEquals($expected, $actual);

        // Only work with numbers
        $actual = fieldToArray('a,b,c,d,e,f');
        $expected = [];
        $this->assertEquals($expected, $actual);
    }
}
