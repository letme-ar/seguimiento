<?php

namespace Tests\Feature;

use App\Models\Carrera;
use App\Models\Curso;
use App\Models\Dia;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Materia;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleCursosTest extends TestCase
{
//    use DatabaseMigrations;

    /** @test */
    function i_can_see_page_cursos()
    {
        $user = $this->generateDocenteUserAndLogin();

        $curso = factory(Curso::class)->create([
            'docente_id' => $user->docente->id
        ]);


        $this->visit('cursos')
        ->assertSee('Listado de cursos')
        ->assertSee($curso->materia->carrera->descripcion)
        ->assertSee($curso->materia->descripcion)
        ->assertSee($curso->horario->descripcion)
        ->assertSee($curso->anio)
        ->assertSee($curso->ayudante->nombre_apellido)
        ->assertSee('Cargar nuevo curso');

    }

    /** @test */
    function i_can_see_page_create_a_curso()
    {
        $this->generateDocenteUserAndLogin();

        $this->get('cursos/create')
            ->assertSee('/cursos')
            ->assertSee('Carrera')
            ->assertSee('Materia')
            ->assertSee('Dia')
            ->assertSee('Horario')
            ->assertSee('Año')
            ->assertSee('Ayudante');
    }

    /** @test */
    function i_can_see_page_edit_a_curso()
    {
        $user = $this->generateDocenteUserAndLogin();

        $curso = factory(Curso::class)->create([
                'docente_id' => $user->docente_id
        ]);

        $this->visit("cursos/edit/{$curso->id}-{$curso->slug}")
            ->assertSee("/cursos/{$curso->id}/update")
            ->assertSee('Carrera')
            ->assertSee('Materia')
            ->assertSee('Dia')
            ->assertSee('Horario')
            ->assertSee('Año')
            ->assertSee('Ayudante');
    }

    /** @test */
    function i_can_create_a_course()
    {
        // having
        $docente = factory(Docente::class)->create();
        $user = factory(User::class)->create(['docente_id' => $docente->id]);

        $this->actingAs($user);

        factory(Materia::class)->create(['id' => 1]);
        factory(Dia::class)->create(['id' => 1]);
        factory(Horario::class)->create(['id' => 1]);
        factory(Docente::class)->create(['id' => 1]);


        // when
        $this->visit('cursos/create')
             ->select(1,'materia_id')
             ->select(1,'dia_id')
             ->select(1,'horario_id')
             ->select(date('Y'),'anio')
             ->select(1,'ayudante_id')
             ->press('Guardar')
             ->seePageIs('/cursos');

        $curso = Curso::all()->last();

        $this->seeInDatabase('cursos',[
            'materia_id' => $curso->materia_id,
            'dia_id' => $curso->dia_id,
            'horario_id' => $curso->horario_id,
            'anio' => $curso->anio,
            'ayudante_id' => $curso->ayudante_id,
            'slug' => $curso->slug
        ]);


    }

    /** @test */
    /*function i_send_a_course_without_a_matter()
    {
        $this->generateDocenteUserAndLogin();

        // when
        $this->visit('cursos/create')
            ->select("",'materia_id')
            ->type('Lunes','dia_id')
            ->select(1,'horario_id')
            ->select(date('Y'),'anio')
            ->select(2,'ayudante_id')
            ->press('Guardar')
            ->seePageIs('/cursos/create')
            ->see('El campo materia es obligatorio');

    }*/

    /** @test */
    /*function i_send_a_course_without_a_day()
    {
        $this->generateDocenteUserAndLogin();

        // when
        $this->visit('cursos/create')
            ->select(1,'materia_id')
            ->select("",'dia_id')
            ->select(1,'horario_id')
            ->select(date('Y'),'anio')
            ->select(2,'ayudante_id')
            ->press('Guardar')
            ->seePageIs('/cursos/create')
            ->see('El campo dia es obligatorio');
    }*/

    /** @test */
    /*function i_send_a_course_without_a_timetable()
    {
        $this->generateDocenteUserAndLogin();

        // when
        $this->visit('cursos/create')
            ->select(1, 'materia_id')
            ->select(2, 'dia_id')
            ->select('', 'horario_id')
            ->select(date('Y'), 'anio')
            ->select(2, 'ayudante_id')
            ->press('Guardar')
            ->seePageIs('/cursos/create')
            ->see('El campo horario es obligatorio');

    }*/

    /** @test */
    /*function i_send_a_course_without_year()
    {
        $this->generateDocenteUserAndLogin();

        // when
        $this->visit('cursos/create')
            ->select(1, 'materia_id')
            ->select(2, 'dia_id')
            ->select(2, 'horario_id')
            ->select('', 'anio')
            ->select(2, 'ayudante_id')
            ->press('Guardar')
            ->seePageIs('/cursos/create')
            ->see('El campo año es obligatorio');

    }*/


    /** @test */
    /*function i_try_to_update_a_course()
    {
        $this->generateUserAndLogin();

        $carrera = factory(Carrera::class)->create();
        factory(Materia::class)->create(['id' => 1,'carrera_id' => $carrera->id]);
        factory(Dia::class)->create(['id' => 1]);
        factory(Horario::class)->create(['id' => 1]);
        factory(Docente::class)->create(['id' => 1]);

        $curso = factory(Curso::class)->create();

        $this->visit("cursos/{$curso->id}-{$curso->slug}/edit")
            ->select(1, 'materia_id')
            ->select(1, 'dia_id')
            ->select(1, 'horario_id')
            ->select(2019, 'anio')
            ->select(1, 'ayudante_id')
            ->press('Guardar')
            ->seeStatusCode(200)
            ->seePageIs('cursos');

        $curso = Curso::all()->last();

//        dd($curso);

        $this->seeInDatabase('cursos',[
            'id' => $curso->id,
            'materia_id' => 1,
            'dia_id' => 1,
            'horario_id' => 1,
            'anio' => 2019,
            'ayudante_id' => 1
        ]);

    }*/

    /*private function dataRequired()
    {
        $this->generateDocenteUserAndLogin();

        $carrara = factory(Carrera::class)->create();
        $materia = factory(Materia::class)->create(['carrera_id' => $carrara->id]);
        $dia = factory(Dia::class)->create();
        $horario = factory(Horario::class)->create();
        $ayudante = factory(Docente::class)->create();
        return compact('materia','dia','horario','ayudante');
    }*/


}
