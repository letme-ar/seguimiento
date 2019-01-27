<?php

namespace Tests\Feature;

use App\Models\Docente;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleDocentesTest extends TestCase
{
    // Mantiene el estado inicial de la base de datos de antes de prueba
    use RefreshDatabase;


    /** @test */

    public function it_see_index_page()
    {
        $this->withoutExceptionHandling();

        $this->generateUserAndLogin();

        $this->get('/docentes/')
            ->assertSee('Agregar')
            ->assertSee('Damian')
            ->assertSee('Ladiani');
    }

    /** @test */
    public function it_see_create_docente_page()
    {
        $this->withoutExceptionHandling();

        $this->generateUserAndLogin();

        $this->get('/docentes/create')
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
    public function it_try_field_nombre_empty()
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
    public function it_try_field_apellido_empty()
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
    public function it_try_field_email_empty()
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
    public function it_try_field_email_wrong()
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
    public function it_try_field_email_duplicate()
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
    public function it_try_update_field_email_repeated()
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
    public function it_try_field_dni_empty()
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
    public function it_try_field_dni_wrong()
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
    public function it_try_field_dni_duplicate()
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
    public function it_try_field_legajo_empty()
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
    public function it_try_field_legajo_wrong()
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
    public function it_try_field_legajo_duplicate()
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

    public function it_try_update_field()
    {
        $email = 'damianladiani@gmail.com';

        $this->withExceptionHandling();

        $randomDocente = factory(Docente::class)->create(['email' => $email]);

        $this->generateUserAndLogin();

        $this->from('/docentes/create')
            ->post('/docentes',[
                'id' => $randomDocente->id,
                'nombre' => 'Damian',
                'apellido' => 'Ladiani',
                'email' => $email,
                'dni' => '12345674',
                'legajo' => '14461',
            ])
            ->assertRedirect('/docentes');
    }

    /** @test */
    public function it_see_page_edit()
    {
        $this->generateUserAndLogin();

        $randomDocente = factory(Docente::class)->create();


        $this->get("docentes/{$randomDocente->id}/edit")
            ->assertSee($randomDocente->nombre)
            ->assertSee($randomDocente->apellido)
            ->assertSee($randomDocente->email)
            ->assertSee($randomDocente->dni)
            ->assertSee($randomDocente->legajo);

    }

}
