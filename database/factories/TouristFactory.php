<?php

use Faker\Generator as Faker;

$factory->define(\App\Tourist::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'sex' => $faker->title,
        'country' => $faker->country,
        'notes' => $faker->text(200),
        'date_of_birth' => $faker->date('d-m-Y', 'now')
    ];
});
