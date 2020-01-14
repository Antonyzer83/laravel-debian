<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    $last_name = $faker->lastName;
    $first_name = $faker->firstName;
    return [
        'name' => $last_name . ' ' . $first_name,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $faker->unique()->safeEmail,
        'bio' => $faker->text,
        'email_verified_at' => now(),
        'password' => Hash::make('azertyuiop'), // password
        'remember_token' => Str::random(10),
    ];
});
