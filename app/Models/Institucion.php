<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'instituciones';
    use HasFactory;

    //Relacion uno a muchos con peticiones
    public function peticiones(){
        return $this->hasMany('App\Models\Peticion');
    }
    
}
