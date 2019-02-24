<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use App\Validations\ValiCursos;
use Illuminate\Http\Request;

class CursosController extends Controller
{

    private $valiCursos;

    public function __construct(ValiCursos $valiCursos)
    {
        $this->valiCursos = $valiCursos;
    }


    public function index()
    {
        $cursos = Curso::where('docente_id',auth()->user()->docente->id)->paginate(env('APP_PAGINATE',10));

        return view('cursos.index',compact('cursos'));
    }

    public function create()
    {
        return view('cursos.form');
    }

    public function store(Request $request)
    {

        $request->merge([
            'docente_id' => auth()->user()->docente->id,
            'slug' => '',
        ]);

        $request->validate($this->valiCursos->getRules(),$this->valiCursos->getMessages());

        $curso = new Curso($request->all());

        $curso->save();

        $curso->setSlug();

        return redirect('cursos')->with('message', 'Guardado correctamente');
    }

    public function edit($curso_id)
    {
        $curso = Curso::where('id',$curso_id)
            ->where('docente_id',auth()->user()->docente->id)
            ->firstOrFail();

        return view('cursos.form',compact('curso'));
    }

    public function update(Request $request,Curso $curso)
    {
        $request->merge([
            'docente_id' => $curso->docente_id,
            'slug' => $curso->slug,
        ]);

        $request->validate($this->valiCursos->getRules());

        $curso->fill($request->all());

        $curso->setSlug();

        $curso->save();

        return redirect('cursos')->with('message', 'Guardado correctamente');

    }



}
