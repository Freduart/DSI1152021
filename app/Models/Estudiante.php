<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    //Relacion uno a uno con persona
    public function persona(){
        return $this->hasOne('App\Models\Persona');
    }

    //Relacion uno a uno con carrera
    public function carrera(){
        return $this->hasOne('App\Models\Carrera');
    }

    //Relacion uno a uno con Constancia de cumplimiento
    public function constanciaCumplimiento(){
        return $this->hasOne('App\Models\ConstanciaCumplimiento');
    }

    //Relacion uno a muchos con bitácoras
    public function bitacora(){
        return $this->hasMany('App\Models\Bitacora');
    }

    //Relacion uno a uno con Solicitud
    public function solicitud(){
        return $this->hasOne('App\Models\Solicitud');
    }
}
