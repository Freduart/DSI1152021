<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VerificarActividadesController extends Controller
{
    //
    public function index()
    {
   
        //Se obtienen todos los campos de tabla actividad
    $actividades = Actividad::all();
    return Inertia::render("Components/VerificarActividades/VerificarActividades",['actividades' => $actividades]);

    }
}
