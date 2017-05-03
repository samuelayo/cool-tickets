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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'image'=>$faker->sentence,
        'remember_token' => str_random(10),
        'provider'=>NULL, 
        'provider_id'=>NULL
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name
    ];
});


// $factory->define(App\Models\BlogPost::class, function (Faker\Generator $faker) {

//     return [
//         'title' => $faker->sentence,
//         'content'=>$faker->paragraph,
//         'user_id'=>factory(App\User::class)->create()->id,
//         'category'=>factory(App\Models\Category::class)->create()->id,
//         'view_count'=>rand(900, 10000),
//         'image'=>$faker->sentence
//     ];
// });

$factory->define(App\Models\BlogPost::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'content'=>$faker->paragraph,
        'user_id'=>factory(App\User::class)->create()->id,
        'category'=>factory(App\Models\Category::class)->create()->id,
        'view_count'=>rand(900, 10000),
        'image'=>'asasa'
    ];
});