<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SolicitudesController extends Controller
{
    //
    public function index()
    {
   
    $solicitudes = Estudiante::join('solicitudes', 'solicitudes.estudiante_id', '=', 'estudiantes.id')
    ->select('*')->get();
        //Se obtienen todos los campos de tabla Solicitudes
    $estudiantes = Estudiante::all();
    return Inertia::render("Components/EvaluarSolicitudes/Solicitudes",['solicitudes' => $solicitudes, 'estudiantes' => $estudiantes]);

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
