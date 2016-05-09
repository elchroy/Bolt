<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Bolt\User::class, function (Faker\Generator $faker) {
    
    // prevent uniquness violations
    $number = rand(100, 1000);

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('bolt'),
        'remember_token' => str_random(10),
        'social_id' => "{$faker->word}_$number",
        'social_link' => 'facebook',
    ];
});
