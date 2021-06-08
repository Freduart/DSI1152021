<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    //Relacion de uno a uno con Usuarios
    public function usuario(){
        return $this->hasOne('App\Models\User');
    }

    //Relacion de uno a uno con Estudiantes
    public function estudiante(){
        return $this->hasOne('App\Models\Estudiante');
    }

    //Relacion uno a uno con EncargadoEscuela
    public function encargadoEscuela(){
        return $this->hasOne('App\Models\EncargadoEscuela');
    }
       
    //Relacion uno a uno con EncargadoFacultad
    public function encargadoFacultad(){
        return $this->hasOne('App\Models\EncargadoFacultad');
    }
}
