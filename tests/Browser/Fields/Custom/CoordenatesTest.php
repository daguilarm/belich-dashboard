<?php

namespace Tests\Browser\Fields\Custom;

use App\Test;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Fields\Setup;
use Tests\DuskTestCase;

// dusk --filter CoordenatesTest
class CoordenatesTest extends DuskTestCase
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
        $this->field = $this->setField('coordenateactions');
    }

    /**
     * Custom attributes test
     *
     * dusk --filter test_coordenates_attributes
     * @return void
     */
    public function test_coordenates_attributes()
    {
        $this->browse(function (Browser $browser) {
            // Create -> toDegrees
            $browser
                ->loginAs($this->user)
                ->visit('dashboard/' . $this->field . '/create')
                ->assertSourceHas('<div id="' . md5('lat_test_coordenate-to-degrees') . '" class="font-normal lowercase font-bold mt-2 capitalize">')
                ->assertSourceHas('<div id="' . md5('lng_test_coordenate-to-degrees') . '" class="font-normal lowercase font-bold mt-2 capitalize">')
                ->type('@dusk-lat_test_coordenate', '56.704356')
                ->click('@dusk-lng_test_coordenate')
                ->assertSourceHas('<div id="d1ea6ad484661637b2662f81251e6925" class="font-normal lowercase font-bold mt-2 capitalize">56° 42\' 15" N</div>')
                ->type('@dusk-lng_test_coordenate', '-120.704356')
                ->click('@dusk-lat_test_coordenate')
                ->assertSourceHas('<div id="faeac661e5e560e803c6ceee7b389fc0" class="font-normal lowercase font-bold mt-2 capitalize">120° 42\' 15" W</div>');
        });
    }
}
