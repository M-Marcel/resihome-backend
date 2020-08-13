<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
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

$factory->define(User::class, function (Faker $faker) {
    // return [
    //     'name' => $faker->name,
    //     'email' => $faker->unique()->safeEmail,
    //     'email_verified_at' => now(),
    //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    //     'remember_token' => Str::random(10),
    // ];

    return [
        'firstname' => $faker->name,
        'lastname' => $faker->name,
        'email' => 'resiadmin@lanepact.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'user_role' => '10',
        'is_admin' => 1,
        'is_superadmin' => 1,
    ];

    // firstname: "Mrs. Fatima McGlynn",
    //  lastname: "Mandy Kunze",
    //  email: "resiadmin@lanepact.com",
    //  is_superadmin: 1,
    //  updated_at: "2020-08-13 13:09:29",
    //  created_at: "2020-08-13 13:09:29",
    //  id: 31,

});
