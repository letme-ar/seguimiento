<?php

namespace Tests\Feature;

use App\Models\Docente;
use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleDocentesTest extends TestCase
{
    // Mantiene el estado inicial de la base de datos de antes de prueba
    use RefreshDatabase;


    /** @test */
    function i_can_see_index_page()
    {
        $this->generateUserAndLogin();

        $this->get('/docentes/')
            ->assertSee('Agregar')
            ->assertSee('Damian')
            ->assertSee('Ladiani');
    }

    /** @test */
    function i_can_see_create_docente_page()
    {
        $this->generateUserAndLogin();

        $this->get('/docentes/create')
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

        $this->from('/docentes/create')
            ->post('/docentes', [
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => 'damianladiani@hotmail.com',
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertRedirect('docentes');

        $this->assertDatabaseHas('docentes',[
            'nombre' => 'Damian',
            'apellido' => 'Ladiani',
            'email' => 'damianladiani@hotmail.com',
            'dni' => '12345674',
            'legajo' => '14461',
        ]);

        $this->assertDatabaseHas('users',[
            'docente_id' => 1,
            'nombre' => 'Damian',
            'apellido' => 'Ladiani',
            'email' => 'damianladiani@hotmail.com',
            'dni' => '12345674',
        ]);


    }


    /** @test */
    function i_can_see_page_show_docente()
    {
        $this->withExceptionHandling();

        $docente = factory(Docente::class)->create();

        $this->generateUserAndLogin();

//        dd($docente->url);

//        dd("docentes.show/".Str::slug($docente->nombre.' '.$docente->apellido));

        $this->get('docentes/show/'.$docente->id."-".$docente->url)
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
//        $this->markTestIncomplete();
//        exit();
        $docente = factory(Docente::class)->create();

        $this->generateUserAndLogin();

        $this->get('/docentes/edit/'.$docente->id."-".$docente->url)
            ->assertSee('docentes/update')
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

        $this->withoutExceptionHandling();

        $randomDocente = factory(Docente::class)->create(['email' => $email]);
        $randomUser = factory(User::class)->create(['docente_id' => $randomDocente->id]);


//        dd($randomDocente->user);
        $this->generateUserAndLogin();

        $this->from('/docentes/edit')
            ->post('docentes/'.$randomDocente->id.'/update',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => $email,
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertRedirect('/docentes');

        $this->assertDatabaseHas('docentes',[
            'id' => $randomDocente->id,
            'nombre' => 'Damian',
            'apellido' => 'Ladiani',
            'email' => $email,
            'dni' => '12345674',
            'legajo' => '14461',
        ]);

        $randomDocente = $randomDocente->fresh();

        $this->assertDatabaseHas('users',[
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

        $this->from('/docentes/create')
            ->post('/docentes', [
                'nombre' => '',
                'apellido' => 'Ladiani',
                'email' => 'damianladiani@hotmail.com',
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertSessionHasErrors(['nombre']);
    }


    /** @test */
    public function i_try_field_apellido_empty()
    {
        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => '',
                'email' => 'damianladiani@hotmail.com',
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertSessionHasErrors(['apellido']);
    }

    /** @test */
    public function i_try_field_email_empty()
    {
        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => '',
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function i_try_field_email_wrong()
    {
        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => 'dadsadsadsaasddsadsaad',
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function i_try_field_email_duplicate()
    {
        $email = 'damianladiani@gmail.com';

        factory(Docente::class)->create(['email' => $email]);

        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => $email,
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function i_try_update_field_email_repeated()
    {
        $email = 'damianladiani@gmail.com';

        $this->withExceptionHandling();

        factory(Docente::class)->create(['email' => $email]);

        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'id' => '',
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => $email,
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertRedirect('/docentes/create')
            ->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function i_try_field_dni_empty()
    {
        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => 'damian@ladiani.com',
                'dni' => '',
                'legajo' => '14461',
            ])
            ->assertSessionHasErrors(['dni']);

    }

    /** @test */
    public function i_try_field_dni_wrong()
    {
        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => 'damian@ladiani.com',
                'dni' => 'dsadsdasdas',
                'legajo' => '14461',
            ])
            ->assertSessionHasErrors(['dni']);

    }

    /** @test */
    public function i_try_field_dni_duplicate()
    {
        $dni = '33794702';

        factory(Docente::class)->create(['dni' => $dni]);

        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => 'damianladiani@gmail.com',
                'dni' => $dni,
                'legajo' => '14461',
            ])
            ->assertSessionHasErrors(['dni']);
    }

    /** @test */
    public function i_try_field_legajo_empty()
    {
        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => 'damian@ladiani.com',
                'dni' => 'dsadsdasdas',
                'legajo' => '',
            ])
            ->assertSessionHasErrors(['legajo']);

    }

    /** @test */
    public function i_try_field_legajo_wrong()
    {
        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => 'damian@ladiani.com',
                'dni' => 'dsadsdasdas',
                'legajo' => 'sadsadsdsaasd',
            ])
            ->assertSessionHasErrors(['legajo']);

    }

    /** @test */
    public function i_try_field_legajo_duplicate()
    {
        $legajo = '14461';

        factory(Docente::class)->create(['legajo' => $legajo]);

        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => 'damianladiani@gmail.com',
                'dni' => '12345674',
                'legajo' => $legajo,
            ])
            ->assertSessionHasErrors(['legajo']);
    }

    /** @test */
    public function i_see_page_edit()
    {
        $this->generateUserAndLogin();

        $randomDocente = factory(Docente::class)->create();


        $this->get("docentes/edit/{$randomDocente->id}-{$randomDocente->nombre} {$randomDocente->apellido}")
            ->assertSee($randomDocente->nombre)
            ->assertSee($randomDocente->apellido)
            ->assertSee($randomDocente->email)
            ->assertSee($randomDocente->dni)
            ->assertSee($randomDocente->legajo);

    }

}
