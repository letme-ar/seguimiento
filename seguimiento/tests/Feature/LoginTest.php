<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_see_login()
    {
        $this->get('/login')
            ->assertSee('Sistema de seguimiento de alumnos')
            ->assertSee('E-Mail')
            ->assertSee('Contraseña')
            ->assertSee('Recordarme')
            ->assertSee('Ingresar')
            ->assertSee('¿Olvidó su contraseña?');

    }

    public function test_correct_sign_in()
    {
        $this->post('/login/', [
                    'email' => 'damianladiani@gmail.com',
                    'password' => '123456'
                ])
                ->assertRedirect('/');
    }

    public function test_email_empty()
    {
        $this->post('/login/',[
            'email' => '',
            'password' => 'dsadadas'
        ])
        ->assertSessionHasErrors(['email']);
    }

    public function test_email_wrong()
    {
        $this->post('/login/',[
            'email' => 'dsasdasdadasdadas',
            'password' => 'dsadadas'
        ])
        ->assertSessionHasErrors(['email']);
    }

    public function test_email_doesnt_exist()
    {
        $this->post('/login/',[
            'email' => 'damianladiani@github.com',
            'password' => '123456'
        ])
        ->assertSessionHasErrors(['email']);
    }

}
