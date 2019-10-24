<?php

namespace Tests\Unit;

use Tests\TestCase;

class ResourcesTest extends TestCase
{
    /** Test */
    public function test_namespace_path()
    {
        $actual = getAllTheResourcesFromFolder()->values();
        $expected = collect([
            'billings',
            'profiles',
            'users',
        ]);
        $this->assertEquals($expected, $actual);
    }
}
