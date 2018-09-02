<?php

use \App\Models\Carrera;
use \App\Models\Materia;
use Illuminate\Database\Seeder;

class CarrerasMateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carreras = factory(Carrera::class, 5)->create();

        $carreras->each(function(Carrera $carrera) use ($carreras) {
            factory(Materia::class)
                ->times(10)
                ->create([
                    'carrera_id' => $carrera->id,
                ]);
        });
    }
}
