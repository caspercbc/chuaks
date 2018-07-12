<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Transaction::class, function (Faker $faker) {

	$createdAt = $faker->dateTimeBetween('-1 years','+1 year', null);
	$updatedAt = Carbon::instance($createdAt)->addDays(rand(0,300));

	return [
		'user_id' => $faker->numberBetween($min = 1, $max = 100),
		'point' => $faker->numberBetween($min = 10, $max = 1000),
		'created_at' => $createdAt,
		'updated_at' => $updatedAt
	];
});