<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    /** @test */
    function i_see_the_correct_page()
    {
        $this->get('password/reset')
            ->assertSee('Restaurar contraseña')
            ->assertSee('E-Mail');
    }

    /** @test */
    function i_send_a_correct_email()
    {
        $this->post('password/email',[
            'email' => 'damianladiani@gmail.com',
        ])->assertRedirect('/');
    }

    /** @test */
    function i_send_an_email_empty()
    {
        $this->post('password/email',[
            'email' => '',
        ])
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    function i_send_an_email_wrong()
    {
        $this->post('password/email',[
            'email' => 'damianladiani@gmail.com11',
        ])
            ->assertSessionHasErrors(['email']);
    }



}
