<?php

namespace Tests\Unit;

use Daguilarm\Belich\Facades\Helper;
use Tests\TestCase;

// test --filter BladeTest
class BladeTest extends TestCase
{
    /** Test */
    // test --filter BladeTest
    public function test_hide_container_for_sm()
    {
        $expected = 'hidden sm:hidden md:flex lg:flex xl:flex';
        $actual = Helper::hideContainerForScreens(['sm']);
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    // test --filter test_hide_container_for_md
    public function test_hide_container_for_md()
    {
        $expected = 'hidden sm:flex md:hidden lg:flex xl:flex';
        $actual = Helper::hideContainerForScreens(['md']);
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    // test --filter test_hide_container_for_lg
    public function test_hide_container_for_lg()
    {
        $expected = 'hidden sm:flex md:flex lg:hidden xl:flex';
        $actual = Helper::hideContainerForScreens(['lg']);
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    // test --filter test_hide_container_for_xl
    public function test_hide_container_for_xl()
    {
        $expected = 'hidden sm:flex md:flex lg:flex xl:hidden';
        $actual = Helper::hideContainerForScreens(['xl']);
        $this->assertEquals($expected, $actual);
    }
}
