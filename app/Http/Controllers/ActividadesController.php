<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ActividadesController extends Controller
{
    //Metodo para ver en la tabla principal todos los campos necesarios de la tabla actividad
    public function index()
    {
        //$actividades= Actividad::all();
        $actividades = Actividad::where('verificado','=','En espera')->get();
        return Inertia::render("Components/Actividades/Actividades",['actividades' => $actividades]);
    }
     
    //Metodo para crear todas las actividades que el estudiante necesita
    public function store(Request $request)
    {
        Actividad::create($request->all());
        return Redirect::route('actividades.index');
    }


    /*public function bitacora()

    {
       

         // consulta de tabla
         $actividades = DB::table('actividades')
         ->select('actividades.id', 'bitacoras.id', 'bitacoras.total_horas','bitacoras.observaciones_bitacora', 'bitacoras.proyecto_social_id','bitacoras.estudiante_id','actividades.nombre_actividad','actividades.fecha_actividad','actividades.total_horas','actividades.verificado')
         ->join('proyectos_sociales', 'proyectos_sociales.id', '=', 'bitacoras.proyecto_social_id')
         ->join('estudiantes', 'estudiantes.id', '=', 'bitacoras.estudiante_id')
         ->join('bitacoras', 'bitacoras.id', '=', 'actividades.bitacora_id')
         ->where('bitacoras.estudiante_id', '=', $idEstudiante)
         ->get();

         return Inertia::render("Components/Actividades/VistaBitacora",['actividades' => $actividades,'bitacoras' => $bitacoras]);
        


    }*/

    
     //Metodo para actualizar todos los campos necesarios de la tabla de actividades
    public function update(Request $request, $id)
    {
        $actividades=Actividad::find($id);
        $actividades->update($request->all());
        return Redirect::route('actividades.index');
    }


     //Metodo para borrar todas las actividades
    public function destroy($id)
    {
        $actividades=Actividad::find($id);
        $actividades->delete();
        return Redirect::route('actividades.index');
    }
}
