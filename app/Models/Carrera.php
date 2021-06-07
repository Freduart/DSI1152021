<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'carreras';
    use HasFactory;

    //Relacion muchos a uno (inversa de uno a muchos)
    public function facultad(){
        return $this->belongsTo('App\Models\Facultad');
    }

    //Relacion muchos a muchos con tipos de servicio social
    public function tiposServicioSocial(){
        return $this->belongsToMany('App\Models\TipoServicioSocial');
    }

    //Relacion uno a mucho con peticiones
    public function peticiones(){
        return $this->hasMany('App\Models\Peticion');
    }

    //Relacion uno a uno con estudiante
    public function estudiante(){
        return $this->hasOne('App\Models\Estudiante');
    }
}
