<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Bitacora;
use App\Models\Estudiante;
use App\Models\Carrera;
use App\Models\Facultad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BitacoraController extends Controller
{
    //Metodo para visualizar todos los campos de las actividades
    public function index()
    {
        //$bitacoras = Bitacora::all();
        //$actividades= Actividad::all();
        $actividades = DB::table('actividades')
        ->select('actividades.id as id', 'actividades.nombre_actividad as nombre', 'actividades.total_horas as thoras',
        'actividades.verificado as verificado')
        ->join('bitacoras','bitacoras.id','=','actividades.bitacora_id')
        ->join('proyectos_sociales','proyectos_sociales.id','=','bitacoras.proyecto_social_id')
        ->where('verificado', '=', 'Aceptada')
        ->orWhere('verificado', '=', 'Reportada')->get();

        //$idUsuario = 2;
        $idUsuario = Auth::id();

        $estudiante = Estudiante::where('user_id','=', $idUsuario)->firstOrFail();
        $idCarreraEstudiante = $estudiante->carrera_id;
        $est = $estudiante->nombre_estudiante . ' ' . $estudiante->apellido_estudiante;
        $carnet = $estudiante->carnet_estudiante . ' ';

        $carreraEstudiante = Carrera::find($idCarreraEstudiante);
        $idFacultad = $carreraEstudiante->facultad_id;
        $carrera = $carreraEstudiante->nombre_carrera . ' ';

        $facultadEstudiante = Facultad::find($idFacultad);
        $facultad = $facultadEstudiante->nombre_facultad . ' ';

        return Inertia::render("Components/Actividades/FormBitacora",['actividades' => $actividades, 'est'=>$est, 'carnet'=>$carnet, 'carrera' => $carrera, 'facultad' => $facultad]);
    }
}
