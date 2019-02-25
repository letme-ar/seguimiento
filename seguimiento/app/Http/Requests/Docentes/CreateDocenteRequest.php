<?php

namespace App\Http\Requests;

use App\Mail\MailWelcome;
use App\Models\Docente;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CreateDocenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => "required|email|max:50|unique:docentes,email",
            'dni' => "required|unique:docentes,dni|numeric|digits_between:7,8",
            'legajo' => "required|unique:docentes,legajo|digits_between:3,20",

        ];
    }

    public function save()
    {
        $this->validated();

        $docente = new Docente($this->validated());

        DB::transaction(function () use ($docente){

            $docente->save();

            $user = $this->fillCreateUser($docente);

            $user->save();

            $this->SendMailWelcome($user);
        });


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

    private function SendMailWelcome($user): void
    {
        Mail::to(
            $user->email,
            $user->nombre_apellido
        )->send(new MailWelcome($user));
    }


}
