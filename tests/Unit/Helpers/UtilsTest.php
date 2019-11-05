<?php

namespace Tests\Unit;

use Daguilarm\Belich\Facades\Helper;
use Tests\TestCase;

//test --filter UtilsTest
class UtilsTest extends TestCase
{
    /** Test */
    //test --filter test_field_to_array
    public function test_field_to_array()
    {
        $actual = Helper::fieldToArray('1,2,3,4,5,6');
        $expected = [1,2,3,4,5,6];
        $this->assertEquals($expected, $actual);

        // Only work with numbers
        $actual = Helper::fieldToArray('a,b,c,d,e,f');
        $expected = [];
        $this->assertEquals($expected, $actual);
    }
}
