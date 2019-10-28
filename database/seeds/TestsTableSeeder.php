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
        factory(App\Test::class, 100)->create();
    }
}
