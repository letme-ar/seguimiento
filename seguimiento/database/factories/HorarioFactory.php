<?php

use App\Models\Horario;
use Faker\Generator as Faker;

$factory->define(Horario::class, function (Faker $faker) {
    return [
        'descripcion' => 'Noche'
    ];
});
