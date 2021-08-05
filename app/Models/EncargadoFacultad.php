<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncargadoFacultad extends Model
{
    use HasFactory;

    protected $table = 'encargado_facultades';

    protected $fillable = [
        'codigo_encargado_facultad',
        'nombre_encargado_facultad',
        'apellido_encargado_facultad',
        'correo_encargado_facultad',
        'facultad_id',
        'estado_encargado_facultad',
        'user_id',
        'dui_encargado_facultad',
        'telefono_encargado_facultad',
    ];

    //Relacion uno a uno con Facultad
    public function facultad(){
        return $this->hasOne('App\Models\Facultad');
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
