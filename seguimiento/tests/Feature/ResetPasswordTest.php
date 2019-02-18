<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    /** @test */
    function i_see_the_correct_page()
    {
        $this->visit('password/reset')
            ->assertSee('Restaurar contraseña')
            ->assertSee('E-Mail');
    }

    /** @test */
    function i_send_a_correct_email()
    {

        factory(User::class)->create([
            'email' => 'damianladiani@gmail.com'
        ]);

        $this->visit('password/reset')
             ->type('damianladiani@gmail.com','email')
             ->press('Reiniciar contraseña')
             ->seePageIs('password/reset')
             ->see('¡Te hemos enviado por correo el enlace para restablecer tu contraseña!');

    }

    /** @test */
    function i_send_an_email_wrong()
    {
        $this->visit('password/reset')
            ->type('damianladiani@gmail.com','email')
            ->press('Reiniciar contraseña')
            ->seePageIs('password/reset')
            ->see('No podemos encontrar ningún usuario con ese correo electrónico.');

    }



}
