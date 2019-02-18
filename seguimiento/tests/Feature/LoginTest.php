<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_see_login()
    {
        $this->visit("/login")
            ->assertSee('Sistema de seguimiento de alumnos')
            ->assertSee('E-Mail')
            ->assertSee('Contraseña')
            ->assertSee('Recordarme')
            ->assertSee('Ingresar')
            ->assertSee('¿Olvidó su contraseña?');
    }

    public function test_correct_sign_in()
    {

        $user = factory(User::class)->create([
           'nombre' => 'Damian',
           'apellido' => 'Ladiani',
           'email' => 'damianladiani@gmail.com',
           'password' => Hash::make('123456'),
           'password_change' => 0,
            'status' => 1
        ]);

        $this->visit('login')
              ->type('damianladiani@gmail.com','email')
              ->type('123456','password')
              ->press('Ingresar')
              ->seePageIs('/home');
    }

    public function test_email_empty()
    {
        $this->visit('login')
            ->type('','email')
            ->type('123456','password')
            ->press('Ingresar')
            ->see('Estas credenciales no coinciden con nuestros registros');
    }

    public function test_email_wrong()
    {
        $this->visit('login')
            ->type('dsdsadsadasdadadsada','email')
            ->type('123456','password')
            ->press('Ingresar')
            ->see('Estas credenciales no coinciden con nuestros registros');
    }

    public function test_email_doesnt_exist()
    {
        $this->visit('login')
            ->type('damianladiani@github.com','email')
            ->type('123456','password')
            ->press('Ingresar')
            ->see('Estas credenciales no coinciden con nuestros registros');
    }

}
