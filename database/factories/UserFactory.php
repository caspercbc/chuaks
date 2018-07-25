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

$factory->define(App\Reward::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image_url' => 'https://placehold.it/200x200',
        'description' => $faker->text,
        'point' => ($faker->numberBetween($min = 1, $max = 100) * 100)
    ];
});

$factory->define(App\PointTransaction::class, function (Faker $faker) {

	$createdAt = $faker->dateTimeBetween('-1 years','+1 year', null);
	$updatedAt = Carbon::instance($createdAt)->addDays(rand(0,300));

    $rewardId = $faker->boolean();
    $point;
    if( $rewardId ){
        $rewardId = $faker->numberBetween($min = 1, $max = 17);
        $point = $faker->numberBetween($min = -100, $max = -1) * 100;
    } else {
        $rewardId = null;
        $point = $faker->numberBetween($min = 1, $max = 100) * 100;
    }

	return [
		'user_id' => $faker->numberBetween($min = 1, $max = 100),
		'reward_id' => $rewardId,
		'point' => $point,
        'description' => $faker->sentence,
		'created_at' => $createdAt,
		'updated_at' => $updatedAt
	];
});