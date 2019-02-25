<?php

namespace App\Http\Controllers;
use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{

    public function showChangePasswordForm(){

        return view('auth.change-password');
    }

    public function change(ChangePasswordRequest $request)
    {
        $request->save();

        return redirect('/')->with('message', 'Guardado correctamente');
    }


}

