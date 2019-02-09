<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 04/02/19
 * Time: 01:59
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['id','docente_id','materia_id','dia_id','horario_id','anio','ayudante_id','slug'];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function dia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }




}
