<?php

namespace Tests\Feature;

use App\Models\Docente;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleUsersTest extends TestCase
{

    /** @test */
    function i_see_page_change_password()
    {
        $this->generateDocenteUserAndLogin();

        $this->visit('change-password')
            ->see('Contraseña anterior')
            ->see('Nueva contraseña')
            ->see('Repetir contraseña')
            ->see('Cambiar contraseña');

    }

    /** @test */
    function i_can_change_the_password()
    {

        $user = $this->generateDocenteUserAndLogin();

        $user->changePassword('123456');

        $this->visit('change-password')
            ->type('123456','password')
            ->type('12345678','new_password')
            ->type('12345678','new_password_confirmation')
            ->press('Cambiar contraseña')
            ->seePageIs('/')
            ->see('Guardado correctamente');


    }

    /** @test */
    function i_try_change_the_password_without_the_password()
    {

        $this->generateDocenteUserAndLogin();

        $this->visit('change-password')
            ->type('','password')
            ->type('12345678','new_password')
            ->type('12345678','new_password_confirmation')
            ->press('Cambiar contraseña')
            ->seePageIs('change-password')
            ->see('Debe ingresar el password anterior');
    }

    /** @test */
    function i_try_change_the_password_with_wrong_confirmation_password()
    {

        $user = $this->generateDocenteUserAndLogin();
        $user->changePassword('123456');

        $this->visit('change-password')
            ->type('1234563','password')
            ->type('12345678','new_password')
            ->type('123456789','new_password_confirmation')
            ->press('Cambiar contraseña')
            ->seePageIs('change-password')
            ->see('La confirmación del nuevo password no coincide con el password ingresado');


    }


    /** @test */
    function i_try_defuse_an_user()
    {
        $docente = factory(Docente::class)->create();

        $user = factory(User::class)->create([
            'docente_id' => $docente->id,
            'status' => 1
        ]);

        $this->actingAs($user);


        $this->visit('docentes')
            ->press($docente->user->id."-trash")
            ->seePageIs('docentes');

        $this->seeInDatabase('users',[
           'id' => $user->id,
           'status' => 0
        ]);
    }

    /** @test */
    function i_try_activate_an_user()
    {
        $docente = factory(Docente::class)->create();

        $user = factory(User::class)->create([
            'docente_id' => $docente->id,
            'status' => 0
        ]);

        $this->actingAs($user);


        $this->visit('docentes')
            ->press($docente->user->id."-check")
            ->seePageIs('docentes');

        $this->seeInDatabase('users',[
            'id' => $user->id,
            'status' => 1
        ]);

    }

}
