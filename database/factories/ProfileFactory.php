<?php

use Faker\Generator as Faker;

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

$factory->define(\App\Profile::class, function (Faker $faker) {
    return [
        'profile_nick'             => $faker->word(),
        'profile_avatar'           => $faker->imageUrl(200, 200, 'people') ,
        'profile_age'              => rand(18, 75),
        'profile_locale'           => $faker->locale,
    ];
});
