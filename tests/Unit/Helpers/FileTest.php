<?php

namespace Tests\Unit;

use Tests\TestCase;

class FileTest extends TestCase
{
    /** Test */
    public function test_get_file_name()
    {
        $file = 'example.text';
        $expected = 'example';
        $actual = getFileAttributes($file);
        $this->assertEquals($expected, $actual);
    }
}
