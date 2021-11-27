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
                $carreras = [];
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

                $serviciosSocialesByInstitucion = [];                              
            }else if(Auth::user()->hasRole('Encargado Facultad')){

                $idUsuario = Auth::id();
                $encargado = EncargadoFacultad::where('user_id', '=', $idUsuario)->first();
                $usuario = User::where('id', '=', $idUsuario)->first();
                $facultad = Facultad::where('id', '=', $encargado->facultad_id)->first();
                $carreras = Carrera::where('facultad_id', '=', $facultad->id)->get();
                // return($carreras);
                $alumnosBySexo = DB::select(DB::raw("select * from estudiantes 
                    join carreras on carreras.id = estudiantes.carrera_id
                    join facultades on facultades.id = carreras.facultad_id 
                    where carreras.facultad_id = :facultadid"),
                    array('facultadid' => $facultad->id));
                
                $alumnosByEstado = DB::select(DB::raw("select * from estudiantes 
                    join carreras on carreras.id = estudiantes.carrera_id
                    join facultades on facultades.id = carreras.facultad_id 
                    where carreras.facultad_id = :facultadid"),
                    array('facultadid' => $facultad->id));

                $serviciosSocialesByEstado = DB::select(DB::raw("select * from peticiones s 
                    join proyectos_sociales p on p.peticion_id = s.id
                    join carreras c on c.id = s.carrera_id
                    join facultades f on f.id = c.facultad_id 
                    where c.facultad_id = :facultadid"),
                    array('facultadid' => $facultad->id));           

                $serviciosSocialesByTipo = DB::select(DB::raw("select count(nombre_tipo_servicio) as cantTipo, nombre_tipo_servicio, nombre_carrera from peticiones s 
                    join proyectos_sociales p on s.id = p.peticion_id 
                    join tipos_servicio_social t on t.id = s.tipo_servicio_social_id 
                    join carreras c on c.id = s.carrera_id
                    join facultades f on f.id = c.facultad_id 
                    where c.facultad_id = :facultadid
                    group by nombre_tipo_servicio, nombre_carrera"),
                    array('facultadid' => $facultad->id));   
                
                $serviciosSocialesByInstitucion = DB::select(DB::raw("select count(nombre_institucion) as cantInstitucion, nombre_carrera, nombre_institucion from peticiones s 
                    join proyectos_sociales p on s.id = p.peticion_id 
                    join tipos_servicio_social t on t.id = s.tipo_servicio_social_id 
                    join instituciones i on i.id = s.institucion_id
                    join carreras c on c.id = s.carrera_id
                    join facultades f on f.id = c.facultad_id 
                    where c.facultad_id = :facultadid
                    and p.estado_proyecto_social = 'En curso'
                    group by nombre_institucion, nombre_carrera"),
                    array('facultadid' => $facultad->id));              

            }else if(Auth::user()->hasRole('Administrador')){
                $usuario = User::where('rol', '=', 'Administrador')->first();
                $alumnosBySexo = DB::select(DB::raw("select * from estudiantes"));
                // dd($alumnosBySexo);
                $alumnosByEstado = DB::select(DB::raw("select * from estudiantes"));
                // dd($alumnosByEstado);
                $serviciosSocialesByEstado = DB::select(DB::raw("select * from peticiones s join proyectos_sociales p where s.id = p.peticion_id"));
                // dd($serviciosSocialesByEstado);
                $serviciosSocialesByTipo = DB::select(DB::raw("select count(nombre_tipo_servicio) as cantTipo, nombre_tipo_servicio, nombre_carrera from peticiones s 
                    join proyectos_sociales p on s.id = p.peticion_id 
                    join tipos_servicio_social t on t.id = s.tipo_servicio_social_id 
                    join carreras c on c.id = s.carrera_id
                    group by nombre_tipo_servicio, nombre_carrera"));  
                $carreras = Carrera::all();
                $serviciosSocialesByInstitucion = DB::select(DB::raw("select count(nombre_institucion) as cantInstitucion, nombre_carrera, nombre_institucion from peticiones s 
                join proyectos_sociales p on s.id = p.peticion_id 
                join tipos_servicio_social t on t.id = s.tipo_servicio_social_id 
                join instituciones i on i.id = s.institucion_id
                join carreras c on c.id = s.carrera_id
                and p.estado_proyecto_social = 'En curso'
                group by nombre_institucion, nombre_carrera"));   
            }else{
                return Redirect::route('/');
            }
        }else{
            return Redirect::route('login');
        }

        $estudiantes = Estudiante::all();

        return Inertia::render('Components/Estadisticas/Estadisticas', 
        [
            'estudiantesBySexo' => $alumnosBySexo, 
            'carrera' => $carrera, 
            'estudiantesByEstado' => $alumnosByEstado, 
            'serviciosSocialesByEstado' => $serviciosSocialesByEstado, 
            'usuario' => $usuario, 
            'serviciosSocialesByTipo' => $serviciosSocialesByTipo, 
            'carreras' => $carreras, 
            'serviciosSocialesByInstitucion' => $serviciosSocialesByInstitucion
        ]);
    }
}
