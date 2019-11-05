<?php

namespace Tests\Unit;

use Daguilarm\Belich\Facades\Helper;
use Tests\TestCase;

// test --filter IconsTest
class IconsTest extends TestCase
{
    /** Test */
    // test --filter test_icon
    public function test_icon()
    {
        $icon = 'user';
        $text = 'This is a text';
        $css = 'text-lg bg-red-500';
        $actual = Helper::icon($icon, $text, $css);
        $expected = '<i class="fas fa-user mr-2 text-lg bg-red-500"></i>This is a text';
        $this->assertEquals($expected, $actual);

        $actual = Helper::icon($icon);
        $expected = '<i class="fas fa-user icon"></i>';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    // test --filter test_action_icon
    public function test_action_icon()
    {
        $icon = 'user';
        $actual = Helper::actionIcon($icon);
        $expected = '<i class="fas fa-user"></i>';
        $this->assertEquals($expected, $actual);
    }

    /** Test */
    // test --filter test_gravatar
    public function test_gravatar()
    {
        $email = 'user@user.com';
        $size = 100;
        $actual = Helper::gravatar($email, $size);
        $expected = 'https://www.gravatar.com/avatar/88b87698be0bc461f3cacf1f080929d5?s=100&d=mp&r=g';
        $this->assertEquals($expected, $actual);
    }
}
