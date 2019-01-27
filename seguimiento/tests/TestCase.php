<?php

namespace Tests;

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


}
