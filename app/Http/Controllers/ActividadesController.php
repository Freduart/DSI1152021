<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Estudiante;
use App\Models\ProyectoSocial;
use App\Models\Bitacora;
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

    public function show($proyecto_social_id)
    {
        if(Auth::check()){

            if(Auth::user()->hasRole('Estudiante')){
                    // obteniendo el id del usuario logeado
                    $idUsuario = Auth::id();
                    
                    // obteniendo el id del estudiante logeado
                    $estudiante = DB::table('estudiantes')->select('estudiantes.id as idE', 'nombre_facultad', 'nombre_carrera', 'carnet_estudiante', 'nombre_estudiante', 'apellido_estudiante')
                    ->join('carreras','carreras.id', '=', 'estudiantes.carrera_id')
                    ->join('facultades', 'facultades.id', '=', 'carreras.facultad_id')
                    ->where('user_id', '=', $idUsuario)
                    ->first();
                    $idEstudiante = $estudiante->idE;
                    
                    $actividades=DB::table('actividades')
                    ->select('actividades.id','proyectos_sociales.id as proyecto_social_id','actividades.nombre_actividad','actividades.fecha_actividad',
                    'actividades.total_horas','actividades.verificado')
                    ->join('bitacoras','bitacoras.id','=','actividades.bitacora_id')
                    ->join('proyectos_sociales','proyectos_sociales.id','=','bitacoras.proyecto_social_id')
                    ->join('peticiones','peticiones.id','=','proyectos_sociales.peticion_id')
                    ->where('bitacoras.estudiante_id','=', $idEstudiante)
                    ->where('proyectos_sociales.id','=', $proyecto_social_id)
                    ->get();

                    $bitacora = Bitacora::select('bitacoras.id as id', 'estado_bitacora')->where('estudiante_id', '=' , $idEstudiante)->where('proyecto_social_id','=', $proyecto_social_id)->firstOrFail();

                    $servicio = DB::table('proyectos_sociales')->select('nombre_peticion', 'estado_proyecto_social')
                    ->join('peticiones', 'peticiones.id', '=', 'proyectos_sociales.peticion_id')
                    ->where('proyectos_sociales.id', '=', $proyecto_social_id)
                    ->first();

                    /*$bitacora = Bitacora::where('estudiante_id', '=' , $idEstudiante)->where('proyecto_social_id','=', $proyecto_social_id)->first();
                    $idBitacora = $bitacora->id;*/
                    //Consulta de la tabla
                    //$actividades = Actividad::where('verificado','=','En espera')->get();
                    return Inertia::render("Components/Actividades/Actividades",['actividades' => $actividades, 'idServicio' => $proyecto_social_id, 'bitacora' => $bitacora, 'servicio' => $servicio, 'estudiante' => $estudiante]);

                }else{
                    return Redirect::route('dashboard');
                }

            }else{
            return Redirect::route('login');
        }
    }
     
    //Metodo para crear todas las actividades que el estudiante necesita
    public function store(Request $request)
    {
        //Actividad::create($request->all());
        // return $request;

        $actividad = new Actividad;
        $actividad->nombre_actividad = $request->nombre_actividad;
        $actividad->fecha_actividad = $request->fecha_actividad;
        $actividad->total_horas = $request->total_horas;
        $actividad->bitacora_id = $request->bitacora_id;
        

        // $idUsuario = Auth::id();
        // $estudiante = Estudiante::where('user_id', '=', $idUsuario)->firstOrFail();
        // $bitacora = Bitacora::where('estudiante_id', $estudiante)->firstOrFail();
        // $actividad->bitacora_id = $bitacora->id;

        $actividad->save();
        
        
        //return Redirect::route("`/actividades/${$props.idServicio}`");
        //return Redirect::route('actividades/{proyecto_social_id}', 2);
        return redirect()->route('actividades', ['proyecto_social_id' => $request->proyecto_social_id]);
    }

    
     //Metodo para actualizar todos los campos necesarios de la tabla de actividades
    public function update(Request $request, $id)
    {   
        $actividades=Actividad::find($id);
        $actividades->nombre_actividad = $request->nombre_actividad;
        $actividades->fecha_actividad = $request->fecha_actividad;
        $actividades->total_horas = $request->total_horas;
        $actividades->save();

        return redirect()->route('actividades', ['proyecto_social_id' => $request->proyecto_social_id]);
    }


     //Metodo para borrar todas las actividades
    public function destroy($id)
    {
        $actividades=Actividad::find($id);
        $proyecto = ProyectoSocial::join('bitacoras','proyectos_sociales.id','=','bitacoras.proyecto_social_id')
        ->join('actividades','bitacoras.id','=','actividades.bitacora_id')
        ->where('actividades.id', '=', $id)
        ->firstOrFail();

        $actividades->delete();
        return redirect()->route('actividades', ['proyecto_social_id' => $proyecto->proyecto_social_id]);
    }
}
