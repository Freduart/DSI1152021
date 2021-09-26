<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Bitacora;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VerificarActividadesController extends Controller
{
    //
    public function index()
    {
    //Se obtienen todos los campos de tabla actividad
    $actividades = Actividad::where('verificado', '=', 'En espera')->get();
    return Inertia::render("Components/VerificarActividades/VerificarActividades",['actividades' => $actividades]);

    }

    public function update(Request $request, $actividades)
    {
        //utilizamos el método update para cambiar la verificación
        $actividad=Actividad::find($actividades);
        //cambiamos el verificado a Aceptada
        $actividad->verificado = "Aceptada";
        // $contra = "adminadmin";
        $data = $request->input();
        //Guardamos los cambios
        $actividad->save();

        // return $actividades;
        $bitacora = Bitacora::find($actividad->bitacora_id)->firstOrFail();
        // return $bitacora->total_horas;
        // $bitacora->total_horas += $bitacora->total_horas + floor(($actividad->total_horas)/2)+1;
        $bitacora->total_horas += $actividad->total_horas;
        $bitacora->total_horas = floor($bitacora->total_horas/2);
        $bitacora->save();
        // return $bitacora->estudiante_id;
        // $idEstudiante = Bitacora::find($bitacora->id)->firstOrFail();
        // return $idEstudiante;
        // $estudiante = Estudiante::where('id',$bitacora->estudiante_id)->firstOrFail();
        // return $estudiante;

        // $estudiante->cantidad_horas_ss += $actividad->total_horas;
        // return $actividad;
        // $estudiante->save();
        //retornamos a la view de verificar actividades
        return Redirect::route('verificaractividades.index');
    }

    public function destroy(Request $request, $actividades)
    {
        //utilizamos el método update para cambiar la verificación
        $actividad=Actividad::find($actividades);
        //cambiamos el verificado a Reportada
        $actividad->verificado = "Reportada";
        // $contra = "adminadmin";
        $data = $request->input();
        //se guardan los cambios
        $actividad->save();
        //retornamos a la view de verificar actividades
        return Redirect::route('verificaractividades.index');
    }
}
