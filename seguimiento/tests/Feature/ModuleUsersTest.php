<?php

namespace Tests\Feature;

use App\Models\Docente;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_try_refuse_user()
    {
        $this->generateUserAndLogin();

        $randomDocente = factory(Docente::class)->create();

        factory(User::class)->create([
            'docente_id' => $randomDocente->id,
            'status' => 0
        ]);

        $this->delete("users/{$randomDocente->id}")
            ->assertRedirect('/docentes');
    }

    /** @test */
    public function it_try_activate_user()
    {
        $this->generateUserAndLogin();

        $randomDocente = factory(Docente::class)->create();

        factory(User::class)->create([
            'docente_id' => $randomDocente->id,
            'status' => 1
        ]);

        $this->put("users/{$randomDocente->id}")
            ->assertRedirect('/docentes');
    }

    /** @test */

    function i_can_change_the_password()
    {
        $user = $this->generateUserAndLogin();
        $user->changePassword('123456');

        $this->from('change-password')
        ->post('change-password',[
            'password' => '123456',
            'new_password' => '12345678',
            'new_password_confirmation' => '12345678'
        ])->assertRedirect('/');

    }

    /** @test */
    function i_try_change_the_password_without_the_password()
    {
        $user = $this->generateUserAndLogin();
        $user->changePassword('123456');

        $this->from('change-password')
        ->post('change-password',[
            'password' => '',
            'new_password' => '12345678',
            'new_password_confirmation' => '12345678'
        ])->assertSessionHasErrors('password');

    }

    /** @test */
    function i_try_change_the_password_without_wrong_confirmation_password()
    {
        $user = $this->generateUserAndLogin();
        $user->changePassword('123456');

        $this->from('change-password')
        ->post('change-password',[
            'password' => '123456',
            'new_password' => '123456789',
            'new_password_confirmation' => '12345678'
        ])->assertSessionHasErrors('new_password');

    }


}
