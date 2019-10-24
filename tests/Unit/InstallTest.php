<?php

namespace Tests\Unit;

use Tests\TestCase;

// Test for installation proccess
class InstallTest extends TestCase
{
    /** Test */
    public function test_file_config()
    {
        $this->assertTrue(file_exists('./config/belich.php'));
        $this->assertTrue(file_exists('./config/belich/stubs/validate-form.stub'));
    }

    /** Test */
    public function test_file_routes()
    {
        $this->assertTrue(file_exists('./app/Belich/Routes.php'));
    }

    /** Test */
    public function test_file_policy()
    {
        $this->assertTrue(file_exists('./app/Policies/UserPolicy.php'));
    }

    /** Test */
    public function test_file_resources_user()
    {
        $this->assertTrue(file_exists('./app/Belich/Resources/User.php'));
    }

    /** Test */
    public function test_dir_public()
    {
        $this->assertTrue(is_dir('./public/vendor/belich'));
    }

    /** Test */
    public function test_dir_lang()
    {
        $this->assertTrue(is_dir('./resources/lang/vendor/belich'));
    }
}
