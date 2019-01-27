<?php

use \App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $carreras = factory(Carrera::class, 5)->create();

        $carreras->each(function(Carrera $carrera) use ($carreras) {
            factory(Materia::class)
                ->times(10)
                ->create([
                    'carrera_id' => $carrera->id,
                ]);
        });
        */

        Carrera::create([
           'descripcion' => 'Técnico superior en programación',
            'abreviacion' => 'TSP'
        ]);
        Carrera::create([
            'descripcion' => 'Técnico superior en sistemas informáticos',
            'abreviacion' => 'TSSI'
        ]);

    }
}
