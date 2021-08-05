<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    protected $table = 'peticiones';
    use HasFactory;

    //Relacion muchos a uno con carreras
    public function carreras(){
        return $this->belongsTo('App\Models\Carrera');
    }

    //Relacion muchos a uno con tipos de servicio social
    public function tiposServicioSocial(){
        return $this->belongsTo('App\Models\TipoServicioSocial');
    }

    //Relacion muchos a uno con instituciones
    public function instituciones(){
        return $this->belongsTo('App\Models\Institucion');
    }

    //Relacion uno a uno con proyectos sociales
    public function proyectosSociales(){
        return $this->hasOne('App\Models\ProyectoSocial');
    }
}
