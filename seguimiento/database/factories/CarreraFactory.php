<?php

use App\Models\Carrera;
use Faker\Generator as Faker;

$factory->define(Carrera::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->jobTitle,
        'abreviacion' => $faker->word
    ];
});

$factory->define(App\Models\Materia::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->jobTitle,
        'abreviatura' => 'Abr',
        'horas_semanales' => $faker->randomDigit(),
        'cuatrimestre' => $faker->randomElement([1,2]),
        'anio' => 2019,
        'horas_cuatrimestrales' => 45,
        'carrera_id' => factory(Carrera::class)->create()
    ];
});
