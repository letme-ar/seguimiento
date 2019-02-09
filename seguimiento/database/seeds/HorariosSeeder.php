<?php

use App\Models\Horario;
use Illuminate\Database\Seeder;

class HorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::create([
            'descripcion' => 'Mañana'
        ]);

        Horario::create([
            'descripcion' => 'Tarde'
        ]);

        Horario::create([
            'descripcion' => 'Noche'
        ]);
    }
}
