<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;

use App\Models\Estudiante;
use App\Models\EncargadoEscuela;
use App\Models\EncargadoFacultad;
use App\Models\Facultad;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function index(){
        $alumnosBySexo = null;
        $carrera = null;
        if(Auth::check()){
            if(Auth::user()->hasRole('Encargado Escuela')){
                $idUsuario = Auth::id();
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->firstOrFail();
                $usuario = User::where('id', '=', $idUsuario)->firstOrFail();
                $carrera = Carrera::where('id', '=', $encargado->carrera_id)->firstOrFail();
                // dd($carrera);
                // $estudiantes = Estudiante::where('carrera_id', '=', $carrera)->count();
                $alumnosBySexo = DB::select(DB::raw("select * from estudiantes where carrera_id = :carreraid"),
                                         array('carreraid' => $carrera->id));
                // dd($alumnosBySexo);
                $alumnosByEstado = DB::select(DB::raw("select * from estudiantes where carrera_id = :carreraid"),
                                         array('carreraid' => $carrera->id));       
                // dd($alumnosByEstado); 
                $serviciosSocialesByEstado = DB::select(DB::raw("select * from peticiones s join proyectos_sociales p where s.id = p.peticion_id and carrera_id = :carreraid"),
                                         array('carreraid' => $carrera->id));
                // dd($serviciosSocialesByEstado);
                $serviciosSocialesByTipo = DB::select(DB::raw("select count(nombre_tipo_servicio) as cantTipo, nombre_tipo_servicio from peticiones s join proyectos_sociales p on s.id = p.peticion_id and carrera_id = :carreraid join tipos_servicio_social t on t.id = s.tipo_servicio_social_id group by nombre_tipo_servicio"),
                                         array('carreraid' => $carrera->id));   
                // dd($serviciosSocialesByTipo);
                // dd($usuario);                                                
            }else if(Auth::user()->hasRole('Encargado Facultad')){

                $idUsuario = Auth::id();
                $encargado = EncargadoFacultad::where('user_id', '=', $idUsuario)->first();
                $usuario = User::where('id', '=', $idUsuario);
                $facultad = Facultad::where('id', '=', $encargado->facultad_id)->first();
                // return($carreras);
                $alumnosBySexo = DB::select(DB::raw("select count(sexo_estudiante) as cant from estudiantes 
                    join carreras on carreras.id = estudiantes.carrera_id
                    join facultades on facultades.id = carreras.facultad_id 
                    where carreras.facultad_id = :facultadid group by sexo_estudiante"),
                    array('facultadid' => $facultad->id));

                $alumnosByEstado = DB::select(DB::raw("select count(estado_estudiante) as estado from estudiantes 
                    join carreras on carreras.id = estudiantes.carrera_id
                    join facultades on facultades.id = carreras.facultad_id 
                    where carreras.facultad_id = :facultadid group by estado_estudiante"),
                    array('facultadid' => $facultad->id));

                $serviciosSocialesByEstado = DB::select(DB::raw("select count(estado_proyecto_social) as estado from peticiones s 
                    join proyectos_sociales p on p.peticion_id = s.id
                    join carreras c on c.id = s.carrera_id
                    join facultades f on f.id = c.facultad_id 
                    where c.facultad_id = :facultadid group by estado_proyecto_social"),
                    array('facultadid' => $facultad->id));                     

            }else if(Auth::user()->hasRole('Administrador')){
                $usuario = User::where('rol', '=', 'Administrador');
                $alumnosBySexo = DB::select(DB::raw("select count(sexo_estudiante) as cant from estudiantes group by sexo_estudiante"));
                // dd($alumnosBySexo);
                $alumnosByEstado = DB::select(DB::raw("select count(estado_estudiante) as estado from estudiantes group by estado_estudiante"));
                // dd($alumnosByEstado);
                $serviciosSocialesByEstado = DB::select(DB::raw("select count(estado_proyecto_social) as estado from peticiones s join proyectos_sociales p where s.id = p.peticion_id group by estado_proyecto_social"));
                // dd($serviciosSocialesByEstado);
            }
        }else{

        }

        $estudiantes = Estudiante::all();

        return Inertia::render('Components/Estadisticas/Estadisticas', ['estudiantesBySexo' => $alumnosBySexo, 'carrera' => $carrera, 'estudiantesByEstado' => $alumnosByEstado, 'serviciosSocialesByEstado' => $serviciosSocialesByEstado, 'usuario' => $usuario, 'serviciosSocialesByTipo' => $serviciosSocialesByTipo]);
    }
}
