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
        $adminBilling = factory(\App\Billing::class)->create([
            'user_id' => $admin->id
        ]);
        $adminProfile = factory(\App\Profile::class)->create([
            'user_id' => $admin->id
        ]);

        for($x = 1; $x <= 100; $x++) {
            $user = factory(\App\User::class)->create();
            $userBilling = factory(\App\Billing::class)->create([
                'user_id' => $user->id,
                'created_at' => Faker::create()->dateTimeBetween($startDate = 'last month', $endDate = 'now'),
            ]);
            $userProfile = factory(\App\Profile::class)->create([
                'user_id' => $user->id
            ]);
        }

        for($x = 1; $x <= 500; $x++) {
            $user = factory(\App\User::class)->create();
            $userBilling = factory(\App\Billing::class)->create([
                'user_id' => $user->id,
                'created_at' => Faker::create()->dateTimeBetween($startDate = 'last year', $endDate = 'now'),
            ]);
            $userProfile = factory(\App\Profile::class)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
