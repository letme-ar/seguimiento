<?php

namespace Tests\Feature;

use App\Models\Docente;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleUsersTest extends TestCase
{

    /** @test */

    function i_can_change_the_password()
    {
        $this->withoutExceptionHandling();

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


    /** @test */
    function i_try_defuse_an_user()
    {
        $this->withoutExceptionHandling();

        $user = $this->generateDocenteUserAndLogin();

        $user->status = 1;
        $user->save();


        $this->from('docentes')
            ->delete("users/{$user->id}/defuse")
            ->assertRedirect('docentes');

        $this->assertDatabaseHas('users',[
           'id' => $user->id,
           'status' => 0
        ]);
    }

    /** @test */
    function i_try_activate_an_user()
    {
        $this->withoutExceptionHandling();

        $user = $this->generateDocenteUserAndLogin();

        $user->status = 0;
        $user->save();


        $this->from('docentes')
            ->post("users/{$user->id}/activate")
            ->assertRedirect('docentes');

        $this->assertDatabaseHas('users',[
           'id' => $user->id,
           'status' => 1
        ]);
    }

}
