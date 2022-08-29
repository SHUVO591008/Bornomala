<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


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


    return [
        'unique_id' =>  "B".mt_rand(1000, 9999),
        'user_name' => $faker->userName,
        'role' => $faker->randomElement(['student','teacher']),
        'gender' => $faker->randomElement(['male', 'female']),
        'first_name' => $faker->firstName('male'|'female'),
        'last_name' => $faker->lastName('male'|'female'),

        'Fname' => $faker->firstNameMale,
        'Mname' => $faker->firstNameFemale,
        'religion' => $faker->randomElement(['hinduism','islam','buddhists','christianity']),
        'dob' => $faker->date($format = 'Y-m-d', $max = '-20 years'),
        'join_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address_1' => $faker->address,
        'address_2' => $faker->streetAddress,
        'city' => $faker->city,
        'status' => $faker->randomElement(['active','inactive','banned']),
        'image' =>$faker->imageUrl,
        'mobile' =>$faker->e164PhoneNumber,

        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('123456789'), // password
        'remember_token' => Str::random(10),
    ];
});
