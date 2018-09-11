<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
