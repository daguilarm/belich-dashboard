<?php

namespace Tests\Unit;

use Daguilarm\Belich\Facades\Helper;
use Tests\TestCase;

// test --filter FileTest
class FileTest extends TestCase
{
    /** Test */
    // test --filter test_get_file_name
    public function test_get_file_name()
    {
        $file = 'example.text';
        $expected = 'example';
        $actual = Helper::getFileAttributes($file);
        $this->assertEquals($expected, $actual);
    }
}
