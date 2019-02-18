<?php

namespace Tests\Feature;

use App\Models\Docente;
use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleDocentesTest extends TestCase
{


    /** @test */
    function i_can_see_index_page()
    {
        $this->generateDocenteUserAndLogin();

        $docente = factory(Docente::class)->create();

        factory(User::class)->create(['docente_id' => $docente->id]);

        $this->visit('docentes/')
            ->assertSee($docente->nombre)
            ->assertSee($docente->apellido)
            ->assertSee($docente->mail);
    }

    /** @test */
    function i_can_see_create_docente_page()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->assertSee('post')
            ->assertSee('Cargar un docente')
            ->assertSee('Nombre')
            ->assertSee('Apellido')
            ->assertSee('Correo electrónico')
            ->assertSee('DNI')
            ->assertSee('Legajo')
            ->assertSee('Guardar')
            ->assertSee('Volver');
    }

    /** @test */
    function i_can_create_a_docente()
    {
        $this->generateUserAndLogin();

        $this->visit('docentes/create')
            ->type('Diana','nombre')
            ->type('Soto','apellido')
            ->type('dianasoto@hotmail.com','email')
            ->type('12345678','dni')
            ->type('12345','legajo')
            ->press('Guardar')
            ->seePageIs('docentes');


        $this->seeInDatabase('docentes',[
            'nombre' => 'Diana',
            'apellido' => 'Soto',
            'email' => 'dianasoto@hotmail.com',
            'dni' => '12345678',
            'legajo' => '12345',
        ]);

        $docente = Docente::all()->last();

        $docente = $docente->fresh();

        $this->seeInDatabase('users',[
            'docente_id' => $docente->id,
            'nombre' => $docente->nombre,
            'apellido' => $docente->apellido,
            'email' => $docente->email,
            'dni' => $docente->dni,
        ]);


    }


    /** @test */
    function i_can_see_page_show_docente()
    {
        $docente = factory(Docente::class)->create();

        $this->generateUserAndLogin();

        $this->visit('docentes/show/'.$docente->id."-".$docente->url)
            ->assertSee($docente->FullName)
            ->assertSee($docente->nombre)
            ->assertSee($docente->apellido)
            ->assertSee($docente->dni)
            ->assertSee($docente->mail)
            ->assertSee($docente->legajo);
    }


    /** @test */
    function i_can_see_page_edit_docente()
    {
        $docente = factory(Docente::class)->create();

        $this->generateUserAndLogin();

        $this->visit('/docentes/edit/'.$docente->id."-".$docente->url)
            ->assertSee("docentes/$docente->id/update")
            ->assertSee('Cargar un docente')
            ->assertSee('Nombre')
            ->assertSee('Apellido')
            ->assertSee('Correo electrónico')
            ->assertSee('DNI')
            ->assertSee('Legajo')
            ->assertSee('Guardar')
            ->assertSee('Volver');
    }


    /** @test */
    public function i_can_update_field()
    {

        $email = 'damianladiani@gmail.com';

        $randomDocente = factory(Docente::class)->create(['email' => $email]);
        factory(User::class)->create(['docente_id' => $randomDocente->id]);

        $this->generateUserAndLogin();

        $this->visit('docentes/edit/'.$randomDocente->id."-".$randomDocente->url)
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type($email,'email')
            ->type('12345674','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->seePageIs('docentes');

        $this->seeInDatabase('docentes',[
            'id' => $randomDocente->id,
            'nombre' => 'Damian',
            'apellido' => 'Ladiani',
            'email' => $email,
            'dni' => '12345674',
            'legajo' => '14461',
        ]);

        $randomDocente = $randomDocente->fresh();

        $this->seeInDatabase('users',[
            'docente_id' => $randomDocente->id,
            'nombre' => $randomDocente->nombre,
            'apellido' => $randomDocente->apellido,
            'dni' => $randomDocente->dni,
            'email' => $randomDocente->email
        ]);

    }



    /** @test */
    function i_try_to_create_a_docente_with_the_field_nombre_empty()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('','nombre')
            ->type('Ladiani','apellido')
            ->type('damianladiani@hotmail.com','email')
            ->type('12345674','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->see('El campo nombre es obligatorio.');
    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_field_apellido_empty()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('','apellido')
            ->type('damianladiani@hotmail.com','email')
            ->type('12345674','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->see('El campo apellido es obligatorio.');
    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_field_email_empty()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type('','email')
            ->type('12345674','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->see('El campo correo electrónico es obligatorio.');
    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_field_email_wrong()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type('sadadasdsaddsasdasdssasdasds','email')
            ->type('12345674','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->see('El campo correo electrónico no es un correo válido');

    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_email_duplicate()
    {
        $email = 'damianladiani@gmail.com';

        factory(Docente::class)->create(['email' => $email]);

        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type($email,'email')
            ->type('12345674','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->see('Ese correo electrónico ya ha sido registrado.');
    }



    /** @test */
    public function i_try_to_create_a_docente_with_the_dni_empty()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type('damianladiani@hotmail.com','email')
            ->type('','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->see('El campo dni es obligatorio.');

    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_dni_wrong()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type('damianladiani@hotmail.com','email')
            ->type('sdadadasd','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->see('El campo dni debe ser numérico.');

    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_dni_duplicate()
    {
        $dni = '33794702';

        factory(Docente::class)->create(['dni' => $dni]);

        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type('damianladiani@hotmail.com','email')
            ->type('','dni')
            ->type('14461','legajo')
            ->press('Guardar')
            ->see('El campo dni es obligatorio.');
    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_legajo_empty()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type('damianladiani@hotmail.com','email')
            ->type('12345678','dni')
            ->type('','legajo')
            ->press('Guardar')
            ->see('El campo legajo es obligatorio.');

    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_legajo_wrong()
    {
        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type('damianladiani@hotmail.com','email')
            ->type('12345678','dni')
            ->type('fdssfsfa','legajo')
            ->press('Guardar')
            ->see('El campo legajo debe tener entre 3 y 20 dígitos.');

    }

    /** @test */
    public function i_try_to_create_a_docente_with_the_legajo_duplicate()
    {
        $legajo = '14461';

        factory(Docente::class)->create(['legajo' => $legajo]);

        $this->generateUserAndLogin();

        $this->visit('/docentes/create')
            ->type('Damian','nombre')
            ->type('Ladiani','apellido')
            ->type('damianladiani@hotmail.com','email')
            ->type('12345678','dni')
            ->type($legajo,'legajo')
            ->press('Guardar')
            ->see('Ese legajo ya ha sido registrado.');

    }

}
