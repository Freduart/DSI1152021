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
    $actividades = Actividad::where('verificado', '=', 'Aceptada')
    ->orWhere('verificado','=','Finalizada')
    ->get();
    return Inertia::render("Components/VerificarActividades/FinalizarActividades",['actividades' => $actividades]);
    }
    
    //utilizaremos el método update para cambiar el verificado de la actividad
    public function update(Request $request, $actividades)
    {
        $actividad=Actividad::find($actividades);
        //cambiamos el verificado de Aceptada a Finalizada
        $actividad->verificado = "Finalizada";
        $data = $request->input();
        //Guardamos los cambios
        $actividad->save();
        //retornamos a la vista de finalizar actividades
        return Redirect::route('finalizaractividades.index');
    }
}
