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

    use RefreshDatabase;


    /** @test */
    public function it_see_page_cursos()
    {

        $this->generateUserAndLogin();

        $this->get('cursos')
        ->assertSee('Listado de cursos')
        ->assertSee('Cargar nuevo curso');

    }

    /** @test */
    function it_press_click_button_cargar_nuevo_curso()
    {
//        $this->withoutExceptionHandling();

        $this->generateUserAndLogin();

        $this->get('cursos/create')
            ->assertSee('Carrera')
            ->assertSee('Materia')
            ->assertSee('Dia')
            ->assertSee('Horario')
            ->assertSee('Año')
            ->assertSee('Ayudante')
            ->assertStatus(200);
    }

    function test_create_a_course()
    {
        $this->withoutExceptionHandling();
        // having
        extract($this->dataRequired());

        // when
        $this->post('cursos',[
            'id' => '',
            'materia_id' => 1,
            'dia_id' => 1,
            'horario_id' => 1,
            'anio' => date('Y'),
            'ayudante_id' => $ayudante->id
        ])->assertRedirect('/cursos');


    }

    function test_course_require_a_matter()
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

    function test_course_require_a_day()
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

    function test_course_require_a_timetable()
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

    function test_course_wrong_year()
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

    function test_course_wrong_assistant()
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

    function test_update_a_course()
    {
        extract($this->dataRequired());

        $this->post('cursos',[
            'id' => '',
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

        $this->post('cursos',[
            'id' => $curso->id,
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

    /*function test_see_show_view()
    {
//        $this->get("");
    }*/


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
