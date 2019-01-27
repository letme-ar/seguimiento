<?php

namespace App\Repositories;

use App\Models\Docente;
use App\User;

class RepoUsers implements RepoBase
{
    public function getModel()
    {
        return new User();
    }

    public function save(Docente $docente)
    {
        $user = $this->getModel()->firstOrNew(['docente_id' => $docente->id]);

        $user = $this->fillUser($user,$docente);

        $user->save();

        return $user;
    }

    private function fillUser(User $user,Docente $docente)
    {
        $user->fill([
            'nombre' => $docente->nombre,
            'apellido' => $docente->apellido,
            'dni' => $docente->dni,
            'email' => $docente->email,
            'docente_id' => $docente->id,
            'user_creator_id' => \Auth::user()->id,
            'tipo_usuario' => 2,
            'password' => \Hash::make($docente->legajo),
            'status' => $user->exists ? $user->status : 1,
            'password_change' => 1

        ]);

        return $user;

    }

    public function defuse($docente_id)
    {
        $user = $this->getModel()->where('docente_id',$docente_id)->first();
        $user->status = 0;
        $user->save();
        return $user;
    }

    public function activate($docente_id)
    {
        $user = $this->getModel()->where('docente_id',$docente_id)->first();
        $user->status = 1;
        $user->save();
        return $user;
    }

    public function updatePassword()
    {

    }


}
