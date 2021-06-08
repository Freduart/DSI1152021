<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncargadoFacultad extends Model
{
    use HasFactory;

    protected $table = 'encargados_facultad';

    //Relacion uno a uno con Carrera
    public function carrera(){
        return $this->hasOne('App\Models\Carrera');
    }

    //Relacion uno a uno con Persona
    public function persona(){
        return $this->hasOne('App\Models\Persona');
    }
}
