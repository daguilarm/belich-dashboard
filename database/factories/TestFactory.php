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
    // Markdown
    $faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($faker));

    // List of countries
    $countries = collect(trans('belich::metrics.countriesOfTheWorldWithCodes'))->map(function($code, $name) {
        return $code['code'];
    })->toArray();

    $boolean = Arr::random([true, false]);

    return [
        'test_password' => bcrypt('12345678'),
        'test_string' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'test_language' => Arr::random(['php', 'python', 'c++', 'cobol', 'js']),
        'test_markdown' => $faker->markdown(),
        'test_color' => $faker->hexcolor,
        'test_url' => $faker->url,
        'test_name' => $faker->firstName(),
        'test_lastname' => $faker->lastName(),
        'test_email' => $faker->safeEmail(),
        'test_telephone' => rand(100000000, 999999999),
        'test_zip' => rand(10000, 99999),
        'test_country' => Arr::random($countries),
        'test_file' => $faker->imageUrl($width = 640, $height = 480),
        'test_file_name' => 'File_original_name_' . Str::random(5),
        'test_file_mime' => Arr::random(['image/x-icon', 'image/gif', 'text/html']),
        'test_file_size' => rand(10, 299),
        'test_mask' => $faker->tollFreePhoneNumber(),
        'test_html' => '<h1 class="text-red-500">Hello world</h1>',
        'test_creditcard_type' => Arr::random(['MasterCard', 'Visa', 'American Express', 'Paypal']),
        'test_creditcard' => rand(100000000, 999999999),
        'test_creditcard_expiration' => $faker->date($format = 'Y-m-d', $max = '2 years'),
        'test_creditcard_json' => json_encode([]),
        'test_json' => json_encode(['name' => $faker->firstName(), 'email' => $faker->safeEmail(), 'telephone' => rand(100000000, 999999999)]),
        'test_address' => $faker->streetAddress(),
        'test_description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'test_enum' => Arr::random(['yes', 'no']),
        'test_decimal' => randNumber(1, 1000, 2),
        'lat_test_coordenate' => randNumber(-90, 90, 2),
        'lng_test_coordenate' => randNumber(-180, 180, 2),
        'test_integer' => randNumber(1, 999),
        'test_number' => randNumber(1, 999),
        'test_ip' => $faker->ipv4(),
        'test_boolean' => $boolean,
        'test_status' => ! $boolean,
        'test_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'test_year' => $faker->year($max = 'now'),
        'test_point' => null,
        'test_polygon' => null,
    ];
});
