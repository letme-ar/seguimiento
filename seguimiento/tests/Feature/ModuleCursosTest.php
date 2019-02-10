<?php

namespace Tests\Feature;

use App\Models\Curso;
use App\Models\Dia;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Materia;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleCursosTest extends TestCase
{


    /** @test */
    function i_can_see_page_cursos()
    {
        $this->generateUserAndLogin();

        $this->get('cursos')
        ->assertSee('Listado de cursos')
        ->assertSee('Cargar nuevo curso');

    }

    /** @test */
    function i_can_see_page_create_a_curso()
    {
        $this->withoutExceptionHandling();

        $this->generateDocenteUserAndLogin();

        $this->get('cursos/create')
            ->assertSee('/cursos')
            ->assertSee('Carrera')
            ->assertSee('Materia')
            ->assertSee('Dia')
            ->assertSee('Horario')
            ->assertSee('Año')
            ->assertSee('Ayudante')
            ->assertStatus(200);
    }

    /** @test */
    function i_can_see_page_edit_a_curso()
    {
        $this->withoutExceptionHandling();

        $this->generateDocenteUserAndLogin();

        $curso = factory(Curso::class)->create();

        $this->get("cursos/edit/{$curso->id}-{$curso->slug}")
            ->assertSee('/cursos/update')
            ->assertSee('Carrera')
            ->assertSee('Materia')
            ->assertSee('Dia')
            ->assertSee('Horario')
            ->assertSee('Año')
            ->assertSee('Ayudante')
            ->assertStatus(200);
    }

    /** @test */
    function i_can_create_a_course()
    {
        $this->withoutExceptionHandling();
        // having
//        extract($this->dataRequired());

        $this->generateDocenteUserAndLogin();

        $curso = factory(Curso::class)->create();

        // when
        $this->post('cursos',[
            'materia_id' => $curso->materia_id,
            'dia_id' => $curso->dia_id,
            'horario_id' => $curso->horario_id,
            'anio' => date('Y'),
            'ayudante_id' => $curso->ayudante_id
        ])->assertRedirect('/cursos');

        $curso = Curso::all()->last();

        $this->assertDatabaseHas('cursos',[
            'materia_id' => $curso->materia_id,
            'dia_id' => $curso->dia_id,
            'horario_id' => $curso->horario_id,
            'anio' => $curso->anio,
            'ayudante_id' => $curso->ayudante_id,
            'slug' => $curso->slug
        ]);


    }

    /** @test */
    function i_send_a_course_without_a_matter()
    {
        extract($this->dataRequired());

        // when
        $this->post('cursos',[
            'id' => '',
            'materia_id' => '',
            'dia_id' => 1,
            'horario_id' => 1,
            'anio' => 1,
            'ayudante_id' => $ayudante->id,
        ])->assertSessionHasErrors(['materia_id']);
    }

    /** @test */
    function i_send_a_course_without_a_day()
    {
        extract($this->dataRequired());

        // when
        $this->post('cursos',[
            'id' => '',
            'materia_id' => 1,
            'dia_id' => '',
            'horario_id' => 1,
            'anio' => 1,
            'ayudante_id' => $ayudante->id,
        ])->assertSessionHasErrors(['dia_id']);
    }

    /** @test */
    function i_send_a_course_without_a_timetable()
    {
        extract($this->dataRequired());

        // when
        $this->post('cursos',[
            'id' => '',
            'materia_id' => 1,
            'dia_id' => 1,
            'horario_id' => '',
            'anio' => 1,
            'ayudante_id' => $ayudante->id,
        ])->assertSessionHasErrors(['horario_id']);
    }


    /** @test */
    function i_send_a_course_with_wrong_year()
    {
        extract($this->dataRequired());

        // when
        $this->post('cursos',[
            'id' => '',
            'materia_id' => 1,
            'dia_id' => 1,
            'horario_id' => '',
            'anio' => 1,
            'ayudante_id' => $ayudante->id,
        ])->assertSessionHasErrors(['anio']);
    }

    /** @test */
    function i_send_a_course_with_wrong_assistant()
    {
        $this->dataRequired();

        // when
        $this->post('cursos',[
            'id' => '',
            'materia_id' => 1,
            'dia_id' => 1,
            'horario_id' => 1,
            'anio' => 1,
            'ayudante_id' => 'ssss',
        ])->assertSessionHasErrors(['ayudante_id']);
    }

    /** @test */
    function i_try_to_update_a_course()
    {
        $this->withoutExceptionHandling();

        extract($this->dataRequired());

        $curso = factory(Curso::class)->create();

        $this->from("cursos/{$curso->id}-{$curso->slug}/edit")
            ->post("cursos/{$curso->id}/update",[
            'materia_id' => $materia->id,
            'dia_id' => $dia->id,
            'horario_id' => $horario->id,
            'anio' => 2019,
            'ayudante_id' => $ayudante->id,
        ])->assertStatus(302);

        $curso = Curso::all()->last();

        $this->assertDatabaseHas('cursos',[
            'materia_id' => $materia->id,
            'dia_id' => $dia->id,
            'horario_id' => $horario->id,
            'anio' => 2019,
            'ayudante_id' => $ayudante->id
        ]);

        $this->post("cursos/{$curso->id}/update",[
            'materia_id' => $materia->id,
            'dia_id' => $dia->id,
            'horario_id' => $horario->id,
            'anio' => 2018,
            'ayudante_id' => $ayudante->id
        ])->assertStatus(302);

        $this->assertDatabaseHas('cursos',[
            'id' => $curso->id,
            'materia_id' => $materia->id,
            'dia_id' => $dia->id,
            'horario_id' => $horario->id,
            'anio' => 2018,
            'ayudante_id' => $ayudante->id
        ]);

    }

    private function dataRequired()
    {
        $this->generateDocenteUserAndLogin();

        $materia = factory(Materia::class)->create();
        $dia = factory(Dia::class)->create();
        $horario = factory(Horario::class)->create();
        $ayudante = factory(Docente::class)->create();
        return compact('materia','dia','horario','ayudante');
    }


}
