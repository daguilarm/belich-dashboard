<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->defineAs(App\User::class, 'admin',  function ($faker) {
    return [
        'name'              => 'admin',
        'email'             => 'admin@email.com',
        'email_verified_at' => now(),
        'password'          => bcrypt('admin'),
        'remember_token'    => Str::random(10)
    ];
});

$factory->afterCreatingState(App\User::class, 'admin', function ($user, $faker) {
    factory(\App\Billing::class)->create([
        'user_id' => $user->id
    ]);
    factory(\App\Profile::class)->create([
        'user_id' => $user->id
    ]);
});

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token'    => Str::random(10),
        'created_at'        => $faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now'),
    ];
});

$factory->afterCreating(App\User::class, function ($user, $faker) {
    factory(\App\Billing::class)->create([
        'user_id' => $user->id,
        'created_at' => $faker->dateTimeBetween($startDate = 'last year', $endDate = 'now')
    ]);
    factory(\App\Profile::class)->create([
        'user_id' => $user->id
    ]);
});
