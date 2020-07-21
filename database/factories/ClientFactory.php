<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->numberBetween($min = 0600000000, $max = 9999999999),
        'tour' => $faker->unique()->randomNumber($nbDigits = 4, $strict = false), // 79907610
        'type' => $faker->randomElement($array = array ('principale','attente')),
        'created_at'=> $faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now', $timezone = null),
    ];
});
