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
    return [
        'first_name' => 'Marbia',
        'last_name' => 'Admin',
        'username' => 'admin',
        'email' => 'amr@rmztech.net',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'user_type' => 'admin',
        'status' => 1,
        'locale' => 'en',
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'admin',function (Faker $faker) {
    return [
        'first_name' => 'Marbia',
        'last_name' => 'Admin',
        'username' => 'admin',
        'email' => 'amr@rmztech.net',
        'phone' => $faker->phoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'user_type' => 'admin',
        'date_birth' => '1995-03-25',
        'status' => 1,
        'locale' => 'en',
        'facebook' => 'https://www.facebook.com/fasseeh/',
        'twitter' => 'https://twitter.com/fasseeh',
        'skype' => 'amr.fasseeh',
        'linkedin' => 'https://www.linkedin.com/in/amr-fasseeh-220466105/',
        'remember_token' => Str::random(10),
    ];
});
