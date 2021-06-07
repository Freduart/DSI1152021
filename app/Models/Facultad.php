<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'facultades';
    use HasFactory;

    //Relacion uno a muchos
    public function carreras(){
        return $this->hasMany('App\Models\Carrera');
    }
}
