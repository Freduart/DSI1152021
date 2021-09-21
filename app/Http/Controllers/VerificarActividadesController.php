<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
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
