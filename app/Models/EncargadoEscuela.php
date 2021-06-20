<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncargadoEscuela extends Model
{
    use HasFactory;

    protected $table = 'encargado_escuelas';

    protected $fillable = [
      'codigo_encargado_escuela',
      'nombre_encargado_escuela',
      'apellido_encargado_escuela',
      'correo_encargado_escuela',
      'carrera_id',
      'estado_encargado_escuela',
      'user_id',
      'dui_encargado_escuela',
      'telefono_encargado_escuela',
  ];

    //Relacion uno a uno con Carrera
    public function carrera(){
        return $this->hasOne('App\Models\Carrera');
    }

    //Relacion uno a uno con Persona
    // public function persona(){
    //     return $this->hasOne('App\Models\Persona');
    // }

    //Relacion uno a uno con Usuario
    public function usuario(){
        return $this->hasOne('App\Models\User');
    }
}
