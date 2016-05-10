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

$factory->define(Bolt\Video::class, function (Faker\Generator $faker) {

    $strings= array('5mPggfOb6Us', '3oT9PQcFZKc', 'wCA6jCUbaFQ', 'zi3ZWe_kTHU', 'zISkHobZ8OM', 'CQp9kEq9kgM', 'k6ZiPqsBvEQ', '9E_vwHbR5Ag', 'yp_gH3zPfbo');
    $random_key = array_rand($strings, 1);
    $random_str = $strings[$random_key];

    return [
        'title'         => $faker->sentence(rand(6, 10), true),
        'description'   => $faker->text(200),
        'url'           => "https://www.youtube.com/watch?v=$random_str",
        'category_id'   => rand(1, 5),
        'user_id'       => rand(1, 5),
    ];
});

$factory->define(Bolt\Category::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->name,
        'brief'     => $faker->sentence(rand(5, 10), true),
        'user_id'   => rand(1, 5),
    ];
});


$factory->define(Bolt\Comment::class, function (Faker\Generator $faker) {
    return [
        'comment'       => $faker->sentence(rand(3, 6), true),
        'video_id'      => rand(1, 5),
        'user_id'       => rand(1, 5)
    ];
});
