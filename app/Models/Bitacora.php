<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacoras';

    protected $fillable =[
        'id',
        'total_horas',
        'observaciones_bitacora',
        'documento_pdf',
        'estudiante_id',
        'proyecto_social_id',

    ];

    //Relacion muchos a uno con Estudiantes
    public function estudiante(){
        return $this->hasOne('App\Models\Estudiante');
    }

    //Relacion de uno a muchos con Actividades
    public function actividades(){
        return $this->hasMany('App\Models\Actividad');
    }
}
