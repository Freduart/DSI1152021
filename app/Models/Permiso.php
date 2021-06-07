<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';

    //Relacion muchos a muchos con roles
    public function roles(){
        return $this->belongsToMany('App\Models\Rol');
    }
}
