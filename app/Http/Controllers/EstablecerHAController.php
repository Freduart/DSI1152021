<?php

namespace App\Http\Controllers;

use App\Models\Peticion;
use App\Models\ProyectoSocial;
use App\Models\TipoServicioSocial;
use App\Models\Carrera;
use Illuminate\Http\Request;

class EstablecerHAController extends Controller
{
    //
    // consulta de tabla
    /*$solicitudes = DB::table('solicitudes')
    ->select('solicitudes.id as idSolicitud', 'peticiones.descripcion_peticion as descripcion', 'peticiones.nombre_peticion as servicio','tipos_servicio_social.nombre_tipo_servicio as tipo', 'instituciones.nombre_institucion as institucion', 'instituciones.rubro_institucion as rubro','instituciones.ubicacion_institucion as ubicacion', 'estudiantes.nombre_estudiante as nombreEstudiante', 'estudiantes.apellido_estudiante as apellidoEstudiante','solicitudes.fecha_solicitud as fecha', 'solicitudes.estado_solicitud as estado', 'solicitudes.justificacion_solicitud as justificacion')
    ->join('proyectos_sociales', 'proyectos_sociales.id', '=', 'solicitudes.proyecto_social_id')
    ->join('peticiones', 'peticiones.id', '=', 'proyectos_sociales.peticion_id')
    ->join('tipos_servicio_social', 'tipos_servicio_social.id', '=', 'peticiones.tipo_servicio_social_id')
    ->join('instituciones', 'instituciones.id', '=', 'peticiones.institucion_id')
    ->join('estudiantes', 'estudiantes.id', '=', 'solicitudes.estudiante_id')
    ->where('solicitudes.estudiante_id', '=', $idEstudiante)
    ->get();*/
}
