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

$factory->define(App\Models\Eventscategory::class, function (Faker\Generator $generator) {
    return [
        'name' => str_random('12')
    ];
});

$factory->define(App\Models\Events::class, function (Faker\Generator $generator) {
    return [
        'title' => $generator->sentence,
        'date' => $generator->dateTimeBetween('now', '+1 year'),
        'image' => "picture",
        'description' => $generator->paragraph,
        'venue' => $generator->sentence,
        'organizer' => $generator->name,
        'category' => factory(App\Models\Eventscategory::class)->create()->id
    ];
});

$factory->define(App\Models\Eventickets::class, function (Faker\Generator $generator) {
    return [
        'name' => $generator->name,
        'price' => $generator->randomNumber(5),
        'image' => "picture",
        'event' => factory(App\Models\Events::class)->create()->id,
        'amount' => $generator->randomNumber(5)
    ];
});