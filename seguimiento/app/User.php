<?php

namespace App;

use App\Models\Docente;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nombre','apellido','dni','email','docente_id','user_creator_id','tipo_usuario','password','status'];
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
        return $this->hasOne(Docente::class,'id','docente_id');
    }


}
