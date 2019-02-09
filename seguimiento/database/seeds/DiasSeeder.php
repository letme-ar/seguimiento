<?php

use App\Models\Dia;
use Illuminate\Database\Seeder;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dia::create([
            'descripcion' => 'Lunes'
        ]);

        Dia::create([
            'descripcion' => 'Martes'
        ]);

        Dia::create([
            'descripcion' => 'Miércoles'
        ]);

        Dia::create([
            'descripcion' => 'Jueves'
        ]);

        Dia::create([
            'descripcion' => 'Viernes'
        ]);

        Dia::create([
            'descripcion' => 'Sábado'
        ]);

        Dia::create([
            'descripcion' => 'Domingo'
        ]);
    }
}
