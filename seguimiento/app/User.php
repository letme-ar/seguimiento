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
        return $this->hasOne(Docente::class,'id','docente_id');
    }

    public function changePassword($new_password)
    {
        $this->attributes['password'] = \Hash::make($new_password);
        $this->attributes['password_change'] = 0;
        $this->save();

    }



}
