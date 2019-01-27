<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'apellido' => $faker->name,
        'dni' => $faker->randomNumber($nbDigits = NULL, $strict = false) ,
        'email' => $faker->unique()->safeEmail,
        'docente_id' => null,
        'tipo_usuario' => 1,
        'user_creator_id' => 1,
        'status' => 1,
        'password_change' => 0,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
