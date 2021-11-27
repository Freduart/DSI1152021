<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\ProyectoSocial;
use App\Models\Institucion;
use App\Models\Bitacora;
use App\Models\TipoServicioSocial;
use App\Models\EncargadoEscuela;
use App\Models\Carrera;
use App\Models\Facultad;
use App\Models\EncargadoFacultad;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;
use PDF;

class ConstanciaController extends Controller
{
    //
    public function index()
    {
        $servicios = DB::table('proyectos_sociales')
        ->select('proyectos_sociales.id as idServicio', 'proyectos_sociales.peticion_id as idPeticion', 'tipos_servicio_social.nombre_tipo_servicio as tipo',
        'peticiones.fecha_peticion as inicio', 'peticiones.fecha_peticion_fin','peticiones.cantidad_horas','peticiones.ubicacion_actividades as ubicacion',
        'encargado_escuelas.nombre_encargado_escuela as encargadoE', 'encargado_facultades.nombre_encargado_facultad as encargadoF',
        'estudiantes.nombre_estudiante as estudiante', 'facultades.nombre_facultad as facultad', 'carreras.nombre_carrera as carrera')
        ->join('peticiones','peticiones.id','=','proyectos_sociales.peticion_id')
        ->join('tipos_servicio_social','tipos_servicio_social.id','=','peticiones.tipo_servicio_social_id')
        ->join('carreras','carreras.id','=','peticiones.carrera_id')
        ->join('facultades','facultades.id','=','carreras.facultad_id')
        ->join('encargado_escuelas','carreras.id','=','encargado_escuelas.carrera_id')
        ->join('encargado_facultades','facultades.id','=','encargado_facultades.facultad_id')
        ->join('estudiantes','carreras.id','=','estudiantes.id')
        ->where('proyectos_sociales.estado_proyecto_social','=','Finalizado')
        ->get();

        //obtiene el id del usuario logeado
        //para poder probar bastata con cambiar $idUsuario = 2;
        //$idUsuario = 2;
        $idUsuario = Auth::id();

        //obteniendo la carrera del estudiante logueado
        $estudiante = Estudiante::where('user_id','=', $idUsuario)->firstOrFail();
        $idCarreraEstudiante = $estudiante->carrera_id;
        $est = $estudiante->nombre_estudiante . ' ' . $estudiante->apellido_estudiante;

        //obteniendo el encargado de la carrera del estudiante
        $encargadosEscuela = EncargadoEscuela::where('carrera_id','=', $idCarreraEstudiante)
        ->where('estado_encargado_escuela','=','Activo')->firstOrFail();
        $encargadoE = $encargadosEscuela->nombre_encargado_escuela . ' ' . $encargadosEscuela->apellido_encargado_escuela;

        //Obteniendo la facultad del estudiante
        $carreraEstudiante = Carrera::find($idCarreraEstudiante);
        $idFacultad = $carreraEstudiante->facultad_id;
        $car = $carreraEstudiante->nombre_carrera . ' ';

        // Facultad a la que pertenece el estudiante
        $facultadEstudiante = Facultad::find($idFacultad);
        $fac = $facultadEstudiante->nombre_facultad . ' ';

        //Obteniendo el encargado de facultad del estudiante
        $encargadoFacultad = EncargadoFacultad::where('facultad_id','=',$idFacultad)
        ->where('estado_encargado_facultad','=','Activo')->firstOrFail();
        $encargadoF = $encargadoFacultad->nombre_encargado_facultad . ' ' . $encargadoFacultad->apellido_encargado_facultad;
        
        //retornamos todos los valores al componente de la constancia
        return Inertia::render("Components/Constancia/Constancia",['servicios' => $servicios, 'encargadoE' => $encargadoE, 'encargadoF' => $encargadoF, 'est'=> $est, 'car'=>$car, 'fac'=>$fac]);
    }

    public function generarPDF($idEstudiante){
        // obteniendo el id del usuario logeado
        $idUsuario = Auth::id();

        // obteniendo el id del estudiante logeado
        $estudiante = DB::table('estudiantes')->select('estudiantes.id as idE', 'nombre_facultad', 'nombre_carrera', 'carnet_estudiante', 
        'nombre_estudiante', 'apellido_estudiante', 'correo_estudiante')
        ->join('carreras','carreras.id', '=', 'estudiantes.carrera_id')
        ->join('facultades', 'facultades.id', '=', 'carreras.facultad_id')
        ->where('user_id', '=', $idUsuario)
        ->first();
        $idEstudiante = $estudiante->idE;

        $servicios = DB::table('proyectos_sociales')
        ->select('tipos_servicio_social.nombre_tipo_servicio', 'peticiones.ubicacion_actividades', 'peticiones.fecha_peticion', 'peticiones.fecha_peticion_fin', 'peticiones.cantidad_horas',
        'encargado_escuelas.nombre_encargado_escuela', 'encargado_facultades.nombre_encargado_facultad')
        ->join('peticiones','peticiones.id','=','proyectos_sociales.peticion_id')
        ->join('tipos_servicio_social','tipos_servicio_social.id','=','peticiones.tipo_servicio_social_id')
        ->join('carreras','carreras.id','=','peticiones.carrera_id')
        ->join('facultades','facultades.id','=','carreras.facultad_id')
        ->join('encargado_escuelas','carreras.id','=','encargado_escuelas.carrera_id')
        ->join('encargado_facultades','facultades.id','=','encargado_facultades.facultad_id')
        ->join('estudiantes','carreras.id','=','estudiantes.id')
        ->join('constancias_cumplimiento','estudiantes.id','=','constancias_cumplimiento.estudiante_id')
        ->where('proyectos_sociales.estado_proyecto_social','=','Finalizado')
        ->where('constancias_cumplimiento.estudiante_id','=',$idEstudiante)
        ->get();

        $total = DB::table('peticiones')
        ->select(DB::raw('SUM(peticiones.cantidad_horas) as totalH'))
        ->join('proyectos_sociales','proyectos_sociales.peticion_id','=','peticiones.id')
        ->join('carreras','peticiones.carrera_id','=','carreras.id')
        ->join('estudiantes','carreras.id','=','estudiantes.carrera_id')
        ->join('constancias_cumplimiento','estudiantes.id','=','constancias_cumplimiento.estudiante_id')
        ->where('proyectos_sociales.estado_proyecto_social','=','Finalizado')
        ->where('constancias_cumplimiento.estudiante_id','=',$idEstudiante)
        ->get();
        //dd($total);
        
        view()->share('servicios', $servicios);
        view()->share('estudiante', $estudiante);
        view()->share('total',$total);
        $pdf = PDF::loadview('PDFs/constanciapdf');
        return $pdf->download('constancia.pdf');
    }
}
