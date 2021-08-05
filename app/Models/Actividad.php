<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    //Relacion muchos a uno con Bitacora
    public function bitacora(){
        return $this->hasOne('App\Models\Bitacora');
    }
}
