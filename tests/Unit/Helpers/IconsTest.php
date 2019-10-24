<?php

namespace Tests\Unit;

use Tests\TestCase;

class IconsTest extends TestCase
{
    /** Test */
    public function test_icon()
    {
        $icon = 'user';
        $text = 'This is a text';
        $css = 'text-lg bg-red-500';
        $actual = icon($icon, $text, $css);
        $expected = '<i class="fas fa-user mr-2 text-lg bg-red-500"></i>This is a text';
        $this->assertEquals($expected, $actual);

        $actual = icon($icon);
        $expected = '<i class="fas fa-user icon"></i>';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_action_icon()
    {
        $icon = 'user';
        $actual = actionIcon($icon);
        $expected = '<i class="fas fa-user"></i>';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    public function test_gravatar()
    {
        $email = 'user@user.com';
        $size = 100;
        $actual = gravatar($email, $size);
        $expected = 'https://www.gravatar.com/avatar/88b87698be0bc461f3cacf1f080929d5?s=100&d=mp&r=g';
        $this->assertEquals($expected, $actual);
    }
}
