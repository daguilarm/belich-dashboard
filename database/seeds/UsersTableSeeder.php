<?php

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

        //Create the admin
        $admin = factory(\App\Models\User::class, 'admin')->create();
        $adminBilling = factory(\App\Models\Billing::class)->create([
            'user_id' => $admin->id
        ]);

        for($x = 1; $x <= 49; $x++) {
            $user = factory(\App\Models\User::class)->create();
            $userBilling = factory(\App\Models\Billing::class)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
