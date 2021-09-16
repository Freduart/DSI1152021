<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoServicioSocial extends Model
{
    protected $table = "tipos_servicio_social";
    use HasFactory;

    protected $fillable =[
        'nombre_tipo_servicio',
        'id',
    ];

    //Relación muchos a muchos con carreras
    public function carreras(){
        return $this->belongsToMany('App\Models\Carrera');
    }

    //Relacion uno a muchos con peticiones
    public function peticiones(){
        return $this->hasMany('App\Models\Peticion');
    }
}
