<?php

namespace App\Http\Controllers;

use App\Mail\MailWelcome;
use App\Models\Docente;
use App\User;
use App\Validations\ValiDocentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DocentesController extends Controller
{
    private $valiDocentes;

    public function __construct(ValiDocentes $valiDocentes)
    {
        $this->valiDocentes = $valiDocentes;
    }


    public function index()
    {
        $docentes = Docente::orderBy('apellido','asc')->paginate(env('APP_PAGINATE',10));

        return view("docentes.index",compact('docentes'));
    }

    public function create()
    {
        $docente = new Docente();
        return view("docentes.form",['docente' => $docente]);
    }

    public function show(Docente $docente,$url)
    {
        return view("docentes.show",compact('docente'));
    }

    public function store(Request $request)
    {
        $request->validate($this->valiDocentes->getRules());

        $docente = new Docente($request->all());

        $docente->save();

        $user = $this->fillCreateUser($docente);

        $user->save();

        $this->SendMailWelcome($user);

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    public function edit(Docente $docente,$url)
    {
        return view("docentes.form",compact('docente'));
    }

    public function update(Request $request,Docente $docente)
    {
        $this->valiDocentes->setId($docente->id);

        $request->validate($this->valiDocentes->getRules());

        $docente->fill($request->all())->save();

        $user = $this->fillUpdateUser($docente->user,$docente);

        $user->save();

        return redirect('docentes')->with('message', 'Guardado correctamente');
    }

    private function fillCreateUser($docente)
    {
        $user = new User();

        $user->fill([
            'nombre' => $docente->nombre,
            'apellido' => $docente->apellido,
            'dni' => $docente->dni,
            'email' => $docente->email,
            'docente_id' => $docente->id,
            'user_creator_id' => auth()->user()->id,
            'tipo_usuario' => 2,
            'password' => \Hash::make($docente->legajo),
            'status' => 1,
            'password_change' => 1
        ]);

        return $user;

    }

    private function fillUpdateUser($user,$docente)
    {
        $user->fill([
            'nombre' => $docente->nombre,
            'apellido' => $docente->apellido,
            'dni' => $docente->dni,
            'email' => $docente->email
        ]);

        return $user;
    }

    /**
     * @param $user
     */
    private function SendMailWelcome($user): void
    {
        Mail::to(
            $user->email,
            $user->nombre_apellido
        )->send(new MailWelcome($user));
    }


}
