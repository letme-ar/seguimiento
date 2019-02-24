<?php

use App\Models\Docente;
use App\User;
use Illuminate\Database\Seeder;

class DocentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $docentes = factory(Docente::class, 50)->create();

        foreach ($docentes as $docente)
        {
            factory(User::class)->create(
                ['docente_id' => $docente->id]
            );
        }

    }
}
