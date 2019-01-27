<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre' => 'Damian',
            'apellido' => 'Ladiani',
            'dni' => '11111111',
            'tipo_usuario' => 1,
            'password' => Hash::make('123456'),
            'email' => 'damianladiani@gmail.com',
            'docente_id' => null,
            'user_creator_id' => 1,
            'status' => 1,
            'password_change' => 0
        ]);

        User::create([
            'nombre' => 'Maximiliano',
            'apellido' => 'Sar Fernandez',
            'dni' => '22222222',
            'tipo_usuario' => 1,
            'password' => Hash::make('123456'),
            'email' => 'msarfernandez@gmail.com',
            'docente_id' => null,
            'user_creator_id' => 1,
            'status' => 1,
            'password_change' => 0
        ]);
    }
}
