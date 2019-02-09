<?php

namespace Tests;

use App\Models\Docente;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function generateUserAndLogin()
    {
        $user = factory(User::class)->create([
            'nombre' => 'Damian',
            'apellido' => 'Ladiani'
        ]);
        \Auth::login($user);

        return $user;
    }

    protected function generateDocenteUserAndLogin()
    {
        $docente = factory(Docente::class)->create();

        $user = factory(User::class)->create([
            'nombre' => 'Damian',
            'apellido' => 'Ladiani',
            'docente_id' => $docente->id
        ]);

        \Auth::login($user);

        return $user;
    }


}
