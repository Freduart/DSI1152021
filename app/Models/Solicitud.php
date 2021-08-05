<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    //Relacion uno a uno con Estudiante
    public function estudiante(){
        return $this->hasOne('App\Models\Estudiante');
    }

    //Relacion muchos a uno con ProyectoSocial
    public function proyectoSocial(){
        return $this->hasOne('App\Models\ProyectoSocial');
    }
}
