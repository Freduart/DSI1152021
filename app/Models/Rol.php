<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    //Relacion muchos a muchos con usuarios
    public function usuarios(){
        return $this->belongsToMany('App\Models\User');
    }

    //Relacion muchos a muchos con permisos
    public function permisos(){
        return $this->belongsToMany('App\Models\Permiso');
    }
}
