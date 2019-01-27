<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_see_correct_page()
    {
        $this->get('password/reset')
            ->assertSee('Restaurar contraseña')
            ->assertSee('E-Mail');
    }

    public function test_send_correct_email()
    {
        $this->post('password/email',[
            'email' => 'damianladiani@gmail.com',
        ])->assertRedirect('/');
    }

    public function test_email_empty()
    {
        $this->post('password/email',[
            'email' => '',
        ])
            ->assertSessionHasErrors(['email']);
    }

    public function test_email_wrong()
    {
        $this->post('password/email',[
            'email' => 'damianladiani@gmail.com11',
        ])
            ->assertSessionHasErrors(['email']);
    }



}
