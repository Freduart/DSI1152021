<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'id',
        'nombre_estudiante',
        'apellido_estudiante',
        'user_id',
        'carnet_estudiante',
        'sexo_estudiante',
        'correo_estudiante',
        'telefono_estudiante',
        'carrera',
        'sexo_estudiante',
        'carnet_estudiante',
        'carrera_id',
        'dui_estudiante',
        'nit_estudiante',
        'materias_cursadas',
        'cantidad_horas_ss',
        'estado_estudiante',
        'nombre_estudiante',
        'apellido_estudiante',
        'correo_estudiante',
        'telefono_estudiante',
        'dui_estudiante',
        'nit_estudiante',
        'porcentaje_aprobacion'
    ];

    //Relacion uno a uno con persona
    // public function persona(){
    //     return $this->hasOne('App\Models\Persona');
    // }

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

    //Relacion uno a uno con Usuario
    public function usuario(){
        return $this->hasOne('App\Models\User');
    }
}
