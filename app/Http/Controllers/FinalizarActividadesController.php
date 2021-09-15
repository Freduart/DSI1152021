<?php


namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FinalizarActividadesController extends Controller
{
    //Metodo para visualizar todos los campos de las actividades
    public function index()
    {
        //Se obtienen todos los campos de tabla actividad
    $actividades = Actividad::where('verificado', '=', 'Aceptada')->get();
    return Inertia::render("Components/VerificarActividades/FinalizarActividades",['actividades' => $actividades]);
    }
}
