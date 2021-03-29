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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

/*$factory->define(\App\WaterProduction::class, function (Faker $faker) {
    return [
        'energy_type_id' => rand(1,0),
        'provincial_zone_id'=>rand(1,50),
        'active_hours'=>rand(1,10),
        'total_pumps'=>rand(1,10),
        'produce_water'=>rand(1,100),
        'expends'=>rand(1000,100000),
        'created_at'=>$faker->dateTimeBetween('-6 months','now')
    ];
});*/

/*$factory->define(\App\Income::class, function (Faker $faker) {
    return [
        'provincial_zone_id'=>rand(1,50),
        'amount'=>rand(1000,100000),
        'created_at'=>$faker->dateTimeBetween('-6 months','now')
    ];
});*/
