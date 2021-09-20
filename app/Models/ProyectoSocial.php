<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoSocial extends Model
{
    protected $table = 'proyectos_sociales';
    use HasFactory;

    protected $fillable =[
        'id',
        'peticion_id',
        'fecha_inicio',
        'fecha_fin',
        'numero_horas',
        'estado_proyecto_Social',
    ];

    //Relacion uno a uno con peticiones
    public function peticiones(){
        return $this->hasOne('App\Models\Peticion');
    }

    //Relacion muchos a muchos con ConstanciaCumplimiento
    public function constanciasCumplimiento(){
        return $this->belongsToMany('App\Models\ConstanciaCumplimiento');
    }

    //Relacion uno a muchos con Solicitud
    public function solicitudes(){
        return $this->hasMany('App\Models\Solicitud');
    }

}
