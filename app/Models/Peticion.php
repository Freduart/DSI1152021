<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    protected $table = 'peticiones';
    use HasFactory;

    protected $fillable = [
        'cantidad_estudiantes',
        'nombre_peticion',
        'descripcion_peticion',
        'ubicacion_actividades',
        'fecha_peticion',
        // Campos nuevos
        'fecha_peticion_fin',
        'cantidad_horas',
        'otros_tipo_servicio',
        'estado_peticion',
        'correo_peticion',
        //Foraneas
        'carrera_id',
        'tipo_servicio_social_id',
        'institucion_id',
    ];

    //Relacion muchos a uno con carreras
    public function carreras(){
        return $this->belongsTo(Carrera::class);
    }

    //Relacion muchos a uno con tipos de servicio social
    public function tiposServicioSocial(){
        return $this->belongsTo(TipoServicioSocial::class);
    }

    //Relacion muchos a uno con instituciones
    public function instituciones(){
        return $this->hasOne(Institucion::class);
    }

    //Relacion uno a uno con proyectos sociales
    public function proyectosSociales(){
        return $this->hasOne(ProyectoSocial::class);
    }    
}
