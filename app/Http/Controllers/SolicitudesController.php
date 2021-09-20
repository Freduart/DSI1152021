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
        //Trae datos de la tabla solicitudes y estudiantes
        $solicitudes = DB::table('solicitudes')
        ->select('solicitudes.id', 'estudiantes.nombre_estudiante', 'estudiantes.apellido_estudiante','solicitudes.fecha_solicitud', 'solicitudes.estado_solicitud', 'solicitudes.justificacion_solicitud')
        ->join('estudiantes', 'estudiantes.id', '=', 'solicitudes.estudiante_id')
        ->where('solicitudes.estado_solicitud', '=', 'En Espera','OR','solicitudes.estado_solicitud', '=', 'Rechazado')
        ->get();

    return Inertia::render("Components/EvaluarSolicitudes/Solicitudes",['solicitudes' => $solicitudes]);

    }

    public function destroy(Request $request, $solicitud)
    {
        $solicitudE=Solicitud::find($solicitud);
        $solicitudE->estado_solicitud = "Rechazado";
        $data = $request->input();
        $solicitudE->save();
        /*$solicitudE->delete();*/
        return Redirect::route('solicitudes.index');
    }

    public function update(Request $request, $solicitud)
    {
        $solicitudE=Solicitud::find($solicitud);
        //$solicitudE->estado_solicitud = "Aprobado";
        $solicitudE->estado_solicitud = "Aceptado";
        $data = $request->input();
        $solicitudE->save();

        return Redirect::route('solicitudes.index');

    }
}
