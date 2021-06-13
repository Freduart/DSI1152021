<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncargadoFacultad extends Model
{
    use HasFactory;

    protected $table = 'encargado_facultades';

    //Relacion uno a uno con Facultad
    public function facultad(){
        return $this->hasOne('App\Models\Facultad');
    }

    //Relacion uno a uno con Persona
    // public function persona(){
    //     return $this->hasOne('App\Models\Persona');
    // }

    //Relacion uno a uno con Usuario
    public function usuario(){
        return $this->hasOne('App\Models\User');
    }
}
