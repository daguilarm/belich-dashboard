<?php

namespace Tests\Unit;

use Daguilarm\Belich\Facades\Helper;
use Tests\TestCase;

//test --filter ResourcesTest
class ResourcesTest extends TestCase
{
    /** Test */
    //test --filter test_all_the_resources
    public function test_all_the_resources()
    {
        $actual = Helper::getAllTheResourcesFromFolder()->values()->take(2);
        $expected = collect([
            'profiles',
            'users',
        ]);
        $this->assertEquals($expected, $actual);
    }
}
