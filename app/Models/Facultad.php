<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'facultades';
    use HasFactory;

    protected $fillable =[
        'nombre_facultad',
        'id',
    ];

    //Relacion uno a muchos
    public function carreras(){
        return $this->hasMany('App\Models\Carrera');
    }

    //Relacion uno a uno con EncargadoFacultad
    public function encargadoFacultad(){
        return $this->hasOne('App\Models\EncargadoFacultad');
    }
}
