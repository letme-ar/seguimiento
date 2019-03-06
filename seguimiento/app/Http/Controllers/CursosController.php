<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCursoRequest;
use App\Http\Requests\EditCursoRequest;
use App\Models\Curso;
use App\Models\Materia;

class CursosController extends Controller
{

    public function index()
    {
        $cursos = Curso::where('docente_id',auth()->user()->docente->id)->paginate(env('APP_PAGINATE',10));

        return view('cursos.index',compact('cursos'));
    }

    public function create()
    {
        return view('cursos.form');
    }

    public function store(CreateCursoRequest $request)
    {
        $request->save();

        return redirect('cursos')->with('message', 'Guardado correctamente');
    }

    public function edit($curso_id,$slug)
    {
        $curso = Curso::where('id',$curso_id)
            ->where('docente_id',auth()->user()->docente->id)
            ->where('slug',$slug)
            ->firstOrFail();

        return view('cursos.form',compact('curso'));
    }

    public function update(EditCursoRequest $request,Curso $curso)
    {
        $request->update($curso);

        return redirect('cursos')->with('message', 'Guardado correctamente');

    }

    public function getMaterias($carrera_id=null,$materia_actual_id=null)
    {
        $filter = $this->getCoursesTaken($materia_actual_id);

        return Materia::where('carrera_id',$carrera_id)
            ->whereNotIn('id', $filter)
            ->select(['id','descripcion'])
            ->orderBy('descripcion','asc')->get();
    }

    /**
     * @param $materia_actual_id
     * @return mixed
     */
    public function getCoursesTaken($materia_actual_id)
    {
        $all = auth()->user()->docente->cursos()->pluck('materia_id');

        $filter = $all->filter(function ($value, $key) use ($materia_actual_id) {
            if ($value != $materia_actual_id) {
                return true;
            }
        });
        return $filter->all();
    }


}
