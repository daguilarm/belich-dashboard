<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('billings')->delete();
        DB::table('profiles')->delete();

        //Create the admin
        $admin = factory(\App\User::class, 'admin')->create();

        //Create 200 users
        $users = factory(\App\User::class, 200)->create();
    }
}
