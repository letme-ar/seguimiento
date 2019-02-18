<?php

namespace Tests;

use App\Models\Docente;
use App\User;
//use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    public $baseUrl = 'http://localhost';

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

    protected function assertSee($text)
    {
        return $this->see($text);
    }

    public function seeErrors(array $fields)
    {
        foreach ($fields as $name => $errors) {
            foreach ((array) $errors as $message) {
                $this->seeInElement(
                    "#field_{$name}.has-error .help-block", $message
                );
            }
        }
    }



}
