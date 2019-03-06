<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;

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

$factory->define(\App\Billing::class, function (Faker $faker) {
    return [
        'billing_address'   => $faker->address,
        'billing_name'      => $faker->name(),
        'billing_nif'       => $faker->swiftBicNumber,
        'billing_status'    => rand(0, 1),
        'billing_year'      => rand(2000, 2019),
        'billing_date'      => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'yesterday', $timezone =  config('app.timezone')),
        'billing_telephone' => $faker->tollFreePhoneNumber,
        'billing_price'     => mt_rand(100 * 10, 10000 * 10) / 10,
        'billing_user'      => $faker->userName(),
    ];
});
