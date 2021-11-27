<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Bitacora;
use App\Models\Estudiante;
use App\Models\Carrera;
use App\Models\Facultad;
use App\Models\ProyectoSocial;
use App\Models\Peticion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use PDF;
class BitacoraController extends Controller
{
    //Metodo para visualizar todos los campos de las actividades
    public function index()
    {
        //$bitacoras = Bitacora::all();
        //$actividades= Actividad::all();
        $actividades = DB::table('actividades')
        ->select('actividades.id as id', 'actividades.nombre_actividad as nombre_actividad', 'actividades.total_horas as total_horas',
        'actividades.verificado as verificado', 'actividades.fecha_actividad as fecha_actividad')
        ->join('bitacoras','bitacoras.id','=','actividades.bitacora_id')
        ->join('proyectos_sociales','proyectos_sociales.id','=','bitacoras.proyecto_social_id')
        ->join('estudiantes','estudiantes.id','=','bitacoras.estudiante_id')
        ->join('peticiones','peticiones.id','=','proyectos_sociales.peticion_id')
        ->join('carreras','carreras.id','=','peticiones.carrera_id')
        ->join('facultades','facultades.id','=','carreras.facultad_id')
        // ->where('proyectos_sociales.estado_proyecto_social','=','En curso')
        ->Where('actividades.verificado', '=', 'Aceptada')
        ->orWhere('actividades.verificado', '=', 'Reportada')
        ->get();

        // dd($actividades);
        // return $actividades;
        //$idUsuario = 2;
        //Obtenemos el id del usuario logueado
        $idUsuario = Auth::id();

        //Obtenemos la carrera del estudiante logueado
        $estudiante = Estudiante::where('user_id','=', $idUsuario)
        //el estudiante podrá acceder solamente si está activo
        ->where('estado_estudiante','=','Activo')->firstOrFail();
        $idCarreraEstudiante = $estudiante->carrera_id;
        $est = $estudiante->nombre_estudiante . ' ' . $estudiante->apellido_estudiante;
        $carnet = $estudiante->carnet_estudiante . ' ';

        //Obtenemos la facultad del estudiante logueado
        $carreraEstudiante = Carrera::find($idCarreraEstudiante);
        $idFacultad = $carreraEstudiante->facultad_id;
        $carrera = $carreraEstudiante->nombre_carrera . ' ';

        $facultadEstudiante = Facultad::find($idFacultad);
        $facultad = $facultadEstudiante->nombre_facultad . ' ';

        return Inertia::render("Components/Actividades/FormBitacora",['actividades' => $actividades, 'est'=>$est, 'carnet'=>$carnet, 'carrera' => $carrera, 'facultad' => $facultad]);
    }

    //Para generar el reporte PDF de la bitácora
    //Me guié de esta página:
    //https://diarioprogramador.com/laravel-8-exportar-vista-a-pdf/
    public function generarPDF($proyecto_social_id){

        // obteniendo el id del usuario logeado
        $idUsuario = Auth::id();
        
        // obteniendo el id del estudiante logeado
        $estudiante = DB::table('estudiantes')->select('estudiantes.id as idE', 'nombre_facultad', 'nombre_carrera', 'carnet_estudiante', 'nombre_estudiante', 'apellido_estudiante', 'correo_estudiante')
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

        $totalH = DB::select('SELECT SUM(total_horas) as total_horas FROM actividades WHERE verificado = "Aceptada"');

        view()->share('actividades', $actividades);
        view()->share('estudiante', $estudiante);
        view()->share('servicio', $servicio);
        view()->share('totalH', $totalH);
        $pdf = PDF::loadview('PDFs/bitacorapdf');
        return $pdf->download('bitacorapdf.pdf');
    }
}
