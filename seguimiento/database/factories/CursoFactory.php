<?php

use App\Models\Dia;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Materia;
use Faker\Generator as Faker;

$factory->define(App\Models\Curso::class, function (Faker $faker) {
    return [
        'docente_id' => factory(Docente::class)->create(),
        'materia_id' => factory(Materia::class)->create(),
        'dia_id'     => factory(Dia::class)->create(),
        'horario_id' => factory(Horario::class)->create(),
        'anio'       => 2019,
        'ayudante_id' => factory(Docente::class)->create(),
        'slug' => 'slug'
    ];
});
