<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    protected $table = 'peticiones';
    use HasFactory;

    protected $fillable =[
        'id',
        'cantidad_estudiantes',
        'nombre_peticion',
        'ubicacion_Actividades',
        'fecha_peticion',
        'otros_tipo_servicio',
        'estado_peticion',
        'correo_peticion',
        'carrera_id',
        'tipo_servicio_social_id',
        'institucion_id',
    ];

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
