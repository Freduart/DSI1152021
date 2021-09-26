<?php


namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Bitacora;
use App\Models\ProyectoSocial;
use App\Models\TipoServicioSocial;
use App\Models\Estudiante;
use App\Models\Facultad;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FinalizarActividadesController extends Controller
{
    //Metodo para visualizar todos los campos de las actividades
    public function index()
    {
        //Se obtienen todos los campos de tabla actividad
        $actividades = DB::table('actividades')
        ->select('actividades.id as id', 'actividades.nombre_actividad as nombre_actividad', 'actividades.total_horas as total_horas',
        'actividades.verificado as verificado','actividades.fecha_actividad as fecha_actividad', 'bitacoras.id as idBitacora')
        ->join('bitacoras','bitacoras.id','=','actividades.bitacora_id')
        ->join('proyectos_sociales','proyectos_sociales.id','=','bitacoras.proyecto_social_id')
        ->join('estudiantes','estudiantes.id','=','bitacoras.estudiante_id')
        ->join('peticiones','peticiones.id','=','proyectos_sociales.peticion_id')
        ->join('carreras','carreras.id','=','peticiones.carrera_id')
        ->join('facultades','facultades.id','=','carreras.facultad_id')
        ->join('tipos_servicio_social','tipos_servicio_social.id','=','peticiones.tipo_servicio_social_id')
        ->where('proyectos_sociales.estado_proyecto_social','=','En curso')
        ->where('verificado', '=', 'Aceptada')
        ->orWhere('verificado', '=', 'Finalizada')
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
