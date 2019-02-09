<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Dia::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->dayOfWeek
    ];
});
