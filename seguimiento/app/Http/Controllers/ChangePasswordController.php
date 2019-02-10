<?php

namespace App\Http\Controllers;
use App\Validations\ValiChangePassword;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: damian
 * Date: 04/10/18
 * Time: 17:34
 */

class ChangePasswordController extends Controller
{

    private $valiChangePassword;

    public function __construct(ValiChangePassword $valiChangePassword)
    {
        $this->valiChangePassword = $valiChangePassword;
    }

    public function showChangePasswordForm(){
        return view('auth.change-password');
    }

    public function change(Request $request)
    {
        $request->validate(
            $this->valiChangePassword->getRules(),
            $this->valiChangePassword->getMessages()
        );

        if ($this->checkIfThePasswordIsCorrect($request->get('password')))
        {
            return redirect()->back()->withErrors(['password' => 'El password ingresado es incorrecto']);
        }

        auth()->user()->changePassword($request->get('new_password'));

        return redirect('/')->with('message', 'Guardado correctamente');


    }

    private function checkIfThePasswordIsCorrect($password_entered)
    {
        return !\Hash::check($password_entered, auth()->user()->password);
    }

}

