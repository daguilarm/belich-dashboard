<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create the tests
        factory(App\Test::class)->create([
            'id' => 1,
            'test_name' => 'Damian',
            'test_string' => 'Testing belich or something',
            'test_language' => 'php',
        ]);
        factory(App\Test::class, 100)->create();
    }
}
