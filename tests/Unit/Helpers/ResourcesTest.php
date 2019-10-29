<?php

namespace Tests\Unit;

use Tests\TestCase;

class ResourcesTest extends TestCase
{
    /** Test */
    public function test_all_the_resources()
    {
        $actual = getAllTheResourcesFromFolder()->values()->take(2);
        $expected = collect([
            'profiles',
            'users',
        ]);
        $this->assertEquals($expected, $actual);
    }
}
