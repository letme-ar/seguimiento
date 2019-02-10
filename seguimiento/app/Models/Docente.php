<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Docente extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getUrlAttribute()
    {
        return Str::slug($this->attributes['nombre']." ".$this->attributes['apellido']);
    }

    public function getFullNameAttributes()
    {
        return $this->attributes['nombre']." ".$this->attributes['apellido'];
    }

}
