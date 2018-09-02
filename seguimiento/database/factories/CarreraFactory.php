<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Carrera::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->jobTitle
    ];
});

$factory->define(App\Models\Materia::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->jobTitle
    ];
});
