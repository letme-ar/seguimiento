<?php

use App\Models\TipoUsuario;
use Illuminate\Database\Seeder;

class TiposUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoUsuario::create([
            'descripcion' => 'Administrador'
        ]);

        TipoUsuario::create([
            'descripcion' => 'Docente'
        ]);

        TipoUsuario::create([
            'descripcion' => 'Alumno'
        ]);
    }
}
