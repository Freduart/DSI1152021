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
    $actividades = Actividad::where('verificado', '=', '0')->get();
    return Inertia::render("Components/VerificarActividades/VerificarActividades",['actividades' => $actividades]);

    }

    public function update(Request $request, $actividades)
    {
        $actividad=Actividad::find($actividades);
        $actividad->verificado = "1";
        // $contra = "adminadmin";
        $data = $request->input();
        $actividad->save();
        return Redirect::route('verificaractividades.index');
    }

    public function report(Request $request, $actividades)
    {
        $actividad=Actividad::find($actividades);
        $actividad->verificado="2";
        $data = $request->input();
        $actividad->save();
        return Redirect::route('verificaractividades.index');
    }
}
