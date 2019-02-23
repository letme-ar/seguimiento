<?php

namespace App;

use App\Models\Docente;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nombre','apellido','dni','email','docente_id','user_creator_id','tipo_usuario','password','status','password_change'];
//    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNombreApellidoAttribute()
    {
        return $this->attributes['nombre']." ".$this->attributes['apellido'];
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function changePassword($new_password)
    {
        $this->attributes['password'] = \Hash::make($new_password);
        $this->attributes['password_change'] = 0;
        $this->save();
    }

    public function restartPassword()
    {
        $this->attributes['password'] = \Hash::make($this->docente->legajo);
        $this->attributes['password_change'] = 1;
        $this->save();
    }

    /*public function fillUser(Docente $docente)
    {
        $this->fill([
            'nombre' => $docente->nombre,
            'apellido' => $docente->apellido,
            'dni' => $docente->dni,
            'email' => $docente->email,
            'docente_id' => $docente->id,
            'user_creator_id' => auth()->user()->id,
            'tipo_usuario' => 2,
            'password' => \Hash::make($docente->legajo),
            'status' => $user->exists ? $user->status : 1,
            'password_change' => 1

        ]);

    }*/

    public function defuse()
    {
        $this->attributes['status'] = 0;
        $this->save();
    }

    public function activate()
    {
        $this->attributes['status'] = 1;
        $this->save();
    }





}
