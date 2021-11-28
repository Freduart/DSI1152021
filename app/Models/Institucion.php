<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'instituciones';
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre_institucion',
        'contacto_institucion',
        'correo_institucion',
        'telefono_institucion',
        'ubicacion_institucion',
        'rubro_institucion',
    ];

    //Relacion uno a muchos con peticiones
    public function peticiones(){
        return $this->hasMany(Peticion::class);
    }    

    //Relacion uno a uno con Usuario
    public function usuario(){
        return $this->hasOne('App\Models\User');
    }   
}
