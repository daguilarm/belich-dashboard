<?php

use App\User;
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
        //Create the admin
        $admin = factory(User::class, 'admin')->create();

        //Create 200 users
        $users = factory(User::class, 200)->create();
    }
}
