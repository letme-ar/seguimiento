<?php

namespace App\Http\Controllers;

use App\Mail\MailWelcome;
use App\Models\Docente;
use App\Repositories\RepoDocentes;
use App\Repositories\RepoUsers;
use App\Validations\ValiDocentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DocentesController extends Controller
{
    private $repoDocentes;
    private $repoUsers;

    public function __construct(RepoDocentes $repoDocentes,RepoUsers $repoUsers)
    {
        $this->repoDocentes = $repoDocentes;
        $this->repoUsers = $repoUsers;
    }

    public function index()
    {
        $docentes = $this->repoDocentes->getAll();
        return view("docentes.index",compact('docentes'));
    }

    public function create()
    {
        $docente = $this->repoDocentes->getModel();
        return view("docentes.form",compact('docente'));
    }

    public function store(Request $request)
    {
        $validations = new ValiDocentes();
        $validations->setId($request->get('id'));
        $request->validate($validations->getRules());
        $docente = $this->repoDocentes->save($request);
        $user = $this->repoUsers->save($docente);

        if ($user->wasRecentlyCreated)
            Mail::to($user->email,$user->nombre_apellido)->send(new MailWelcome($user));


        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function edit(Docente $docente)
    {
        return view("docentes.form",compact('docente'));
    }

    public function defuse(Docente $docente)
    {
        $user = $this->repoUsers->defuse($docente->id);
        Mail::to($user->email,$user->nombre_apellido)->send(new MailWelcome($user));
        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function activate(Docente $docente)
    {
        $user = $this->repoUsers->activate($docente->id);
        Mail::to($user->email,$user->nombre_apellido)->send(new MailWelcome($user));
        return redirect('docentes')->with('message', 'Guardado correctamente');
    }
}
