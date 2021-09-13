<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SolicitudesController extends Controller
{
    //
    public function index()
    {

        $solicitudes = DB::table('solicitudes')
        ->select('solicitudes.id', 'estudiantes.nombre_estudiante', 'estudiantes.apellido_estudiante','solicitudes.fecha_solicitud', 'solicitudes.estado_solicitud', 'solicitudes.justificacion_solicitud')
        ->join('estudiantes', 'estudiantes.id', '=', 'solicitudes.estudiante_id')
        ->where('solicitudes.estado_solicitud', '=', 'En Espera')
        ->get();
     /* //Se obtienen todos los campos de tabla estudiante
    $estudiantes = Estudiante::all();
    $solicitudes = Solicitud::join('solicitudes', 'solicitudes.estudiante_id', '=', 'estudiantes.id')
    
    ->where('estado_solicitud', '=', 'En espera')
    ->get();
        
     //Obtiene las solicitudes con estado en espera
     $solicitudes = Solicitud::where('estado_solicitud', '=', 'En espera')->get();*/


    return Inertia::render("Components/EvaluarSolicitudes/Solicitudes",['solicitudes' => $solicitudes]);

    }

    public function destroy(Request $request, $solicitud)
    {
        $solicitudE=Solicitud::find($solicitud);
        $solicitudE->delete();
        return Redirect::route('solicitudes.index');
    }

    public function update(Request $request, $solicitud)
    {
        $solicitudE=Solicitud::find($solicitud);
        //$solicitudE->estado_solicitud = "Aprobado";
        $solicitudE->update($request->all());
        $solicitudE->save();

        return Redirect::route('solicitudes.index');

    }
}
