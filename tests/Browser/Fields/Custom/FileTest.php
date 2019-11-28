<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Storage;
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
        $this->field = $this->setField('fileactions');
    }

    /**
     * Test file upload
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
                ->press('@button-action-create')
                ->waitForText('The resource has been successfully created')
                ->assertPathIs('/dashboard/' . $this->field);

            //Get storage from DB
            $results = Test::find(1);

            // Assert the file was stored...
            Storage::disk('public')->assertExists($results->test_file);

            // Assert all the fields has been stored
            $this->assertDatabaseHas('tests', [
                'test_file' => $results->test_file,
                'test_file_mime' => $results->test_file_mime,
                'test_file_size' => $results->test_file_size,
                'test_file_name' => $results->test_file_name,
            ]);
        });
    }

    /**
     * Test file methods
     *
     * dusk --filter test_file_methods
     * @return void
     */
    public function test_file_methods()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                // Assert disk
                ->assertPresent('@disk-21187f650981e8c768cb05e495c60b50')
                ->assertMissing('@storeName-21187f650981e8c768cb05e495c60b50')
                ->assertMissing('@storeSize-21187f650981e8c768cb05e495c60b50')
                ->assertMissing('@storeMime-21187f650981e8c768cb05e495c60b50')
                // Assert disk and name
                ->assertPresent('@disk-b7cd129c427cf6ae86798630b98d06aa')
                ->assertPresent('@storeName-b7cd129c427cf6ae86798630b98d06aa')
                ->assertMissing('@storeSize-b7cd129c427cf6ae86798630b98d06aa')
                ->assertMissing('@storeMime-b7cd129c427cf6ae86798630b98d06aa')
                // Assert disk, name and size
                ->assertPresent('@disk-143898e5d51e9a43e8561b7032bb3117')
                ->assertPresent('@storeName-143898e5d51e9a43e8561b7032bb3117')
                ->assertPresent('@storeMime-143898e5d51e9a43e8561b7032bb3117')
                ->assertMissing('@storeSize-143898e5d51e9a43e8561b7032bb3117')
                // Assert disk, name and size
                ->assertPresent('@disk-2cdca33992933a0cfe9d3b74cd0c560c')
                ->assertPresent('@storeName-2cdca33992933a0cfe9d3b74cd0c560c')
                ->assertPresent('@storeSize-2cdca33992933a0cfe9d3b74cd0c560c')
                ->assertPresent('@storeMime-2cdca33992933a0cfe9d3b74cd0c560c');
        });
    }
}
