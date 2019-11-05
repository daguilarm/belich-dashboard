<?php

namespace Tests\Unit;

use Daguilarm\Belich\Facades\Helper;
use Tests\TestCase;

//test --filter PathTest
class PathTest extends TestCase
{
    /** Test */
    //test --filter test_namespace_path
    public function test_namespace_path()
    {
        $file = 'MyClass';
        $actual = Helper::namespace_path($file);
        $expected = '\Daguilarm\Belich\MyClass';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    //test --filter test_route_path
    public function test_route_path()
    {
        $file = 'user';
        $actual = Helper::route_path($file);
        $expected = '/dashboard/user';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    //test --filter test_belich_path
    public function test_belich_path()
    {
        $file = 'user';
        $actual = Helper::belich_path($file);
        $expected = 'https://belich-dashboard.test/dashboard/user';
        $this->assertEquals($expected, $actual);
    }
}
