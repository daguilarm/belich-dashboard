<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;
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

$factory->define(App\Test::class, function ($faker) {
    return [
        'test_string' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'test_name' => $faker->firstName(),
        'test_lastname' => $faker->lastName(),
        'test_email' => $faker->safeEmail(),
        'test_telephone' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'test_zip' => $faker->numberBetween($min = 100000000, $max = 999999999),
        'test_file' => $faker->imageUrl($width = 640, $height = 480),
        'test_mask' => $faker->tollFreePhoneNumber(),
        'test_html' => '<h1 class="text-red-500">Hello world</h1>',
        'test_creditcard_type' => $faker->creditCardType(),
        'test_creditcard' => $faker->creditCardNumber(),
        'test_creditcard_expiration' => $faker->creditCardExpirationDateString(),
        'test_creditcard_json' => json_encode($faker->creditCardDetails()),
        'test_json' => json_encode(['name' => $faker->firstName(), 'email' => $faker->safeEmail(), 'telephone' => $faker->numberBetween($min = 100000000, $max = 999999999)]),
        'test_address' => $faker->streetAddress(),
        'test_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'test_enum' => Arr::random(['yes', 'no']),
        'test_decimal' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 100000),
        'test_coordenates' => $faker->latitude($min = -90, $max = 90),
        'test_integer' => $faker->randomNumber($nbDigits = 3, $strict = false),
        'test_number' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'test_ip' => $faker->ipv4(),
        'test_boolean' => Arr::random([true, false]),
        'test_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'test_year' => $faker->year($max = 'now'),
        'test_point' => null,
        'test_polygon' => null,
    ];
});
