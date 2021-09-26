<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable =[
        'id',
        'bitacora_id',
        'nombre_actividad',
        'fecha_actividad',
        'total_horas',
        'verificado',
    ];

    //Relacion muchos a uno con Bitacora
    public function bitacora(){
        return $this->hasOne('App\Models\Bitacora');
    }
}
