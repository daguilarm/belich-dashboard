<?php

namespace Tests\Unit;

use Tests\TestCase;

class PathTest extends TestCase
{
    /** Test */
    public function test_namespace_path()
    {
        $file = 'MyClass';
        $actual = namespace_path($file);
        $expected = '\Daguilarm\Belich\MyClass';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_route_path()
    {
        $file = 'user';
        $actual = route_path($file);
        $expected = '/dashboard/user';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_belich_path()
    {
        $file = 'user';
        $actual = belich_path($file);
        $expected = 'https://belich-dashboard.test/dashboard/user';
        $this->assertEquals($expected, $actual);
    }
}
