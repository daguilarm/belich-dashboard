<?php

namespace Tests\Unit;

use Tests\TestCase;

class BladeTest extends TestCase
{
    /** Test */
    public function test_hide_container_for_sm()
    {
        $expected = 'hidden sm:hidden md:flex lg:flex xl:flex';
        $actual = hideContainerForScreens(['sm']);
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_hide_container_for_md()
    {
        $expected = 'hidden sm:flex md:hidden lg:flex xl:flex';
        $actual = hideContainerForScreens(['md']);
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_hide_container_for_lg()
    {
        $expected = 'hidden sm:flex md:flex lg:hidden xl:flex';
        $actual = hideContainerForScreens(['lg']);
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_hide_container_for_xl()
    {
        $expected = 'hidden sm:flex md:flex lg:flex xl:hidden';
        $actual = hideContainerForScreens(['xl']);
        $this->assertEquals($expected, $actual);
    }
}
