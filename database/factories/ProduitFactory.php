<?php

use Faker\Generator as Faker;

$factory->define(App\Produit::class, function (Faker $faker) {
    return [
        //
        'nombre_sac' => $faker->randomDigitNot(0),
        'tonnage' => $faker->numberBetween($min = 300, $max = 1000),
    ];
});
