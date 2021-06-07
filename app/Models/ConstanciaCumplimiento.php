<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstanciaCumplimiento extends Model
{
    use HasFactory;

    protected $table = 'contancias_cumplimiento';

    //Relacion uno a uno con Estudiante
    public function estudiante(){
        return $this->hasOne('App\Models\Estudiante');
    }

    //Relacion muchos a muchos con ProyectoSocial
    public function proyectosSociales(){
        return $this->belongsToMany('App\Models\ProyectoSocial');
    }
}
