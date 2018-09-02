<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Docente::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'email' => $faker->unique()->email,
        'dni' => $faker->unique()->numberBetween($min = 10000000, $max = 50000000),
        'legajo' => $faker->unique()->numberBetween($min = 10000,$max = 200000)
    ];
});

?>