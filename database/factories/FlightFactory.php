<?php

use Faker\Generator as Faker;

$factory->define(\App\Flight::class, function (Faker $faker) {
    return [
        'departure' => $faker->date('d-m-Y', 'now'),
        'arrival' => $faker->date('d-m-Y', 'tomorrow'),
        'seats' => $faker->numberBetween(4, 10),
        'price' => $faker->numberBetween(100, 300),
    ];
});
