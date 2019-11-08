<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter FileTest
class FileTest extends DuskTestCase
{
    use DatabaseMigrations, Setup;

    protected $field;
    protected $test;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->test = factory(Test::class)->create();
        $this->field = $this->setField('fileactions');
    }

    /**
     * Custom attributes test
     *
     * dusk --filter test_file_upload
     * @return void
     */
    public function test_file_upload()
    {
        $this->browse(function (Browser $browser) {
            // Testing forms
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->attach('#test_file', storage_path('app/tests/image.jpeg'))
                ->click('@button-action-create');
        });
    }
}
