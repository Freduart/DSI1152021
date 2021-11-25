<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\ProyectoSocial;
use App\Models\TipoServicioSocial;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Estudiante;
use App\Models\EncargadoEscuela;
use App\Models\Solicitud;

class ServicioSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Estudiante')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el id del estudiante logeado
                $estudiante = Estudiante::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEstudiante = $estudiante->id;

                // consulta de servicio activo
                $servicioActivo = DB::table('solicitudes')
                ->select('nombre_peticion as servicio', 'proyectos_sociales.id as idServicio', 'nombre_tipo_servicio as tipo', 'descripcion_peticion as descripcion', 'ubicacion_actividades', 'peticiones.fecha_peticion as fechaInicio', 'peticiones.fecha_peticion_fin as fechaFin', 'peticiones.cantidad_horas as numHoras', 'estado_proyecto_social as estado', 'nombre_institucion as institucion', 'rubro_institucion as rubro', 'contacto_institucion as contacto', 'correo_institucion as correo', 'telefono_institucion as telefono', 'ubicacion_institucion as ubicacion')
                ->join('proyectos_sociales', 'proyectos_sociales.id', '=', 'solicitudes.proyecto_social_id')
                ->join('peticiones', 'peticiones.id', '=', 'proyectos_sociales.peticion_id')
                ->join('tipos_servicio_social', 'tipos_servicio_social.id', '=', 'peticiones.tipo_servicio_social_id')
                ->join('instituciones', 'instituciones.id', '=', 'peticiones.institucion_id')
                ->join('estudiantes', 'estudiantes.id', '=', 'solicitudes.estudiante_id')
                ->where('solicitudes.estudiante_id', '=', $idEstudiante)
                ->where('solicitudes.estado_solicitud', '=', 'Aceptado')
                ->where(function($query){
                    $query->where('proyectos_sociales.estado_proyecto_social', '=', 'No iniciado')
                    ->orWhere('proyectos_sociales.estado_proyecto_social', '=', 'En curso');
                })
                ->get();

                // consulta de tabla
                $servicios = DB::table('solicitudes')
                ->join('proyectos_sociales', 'proyectos_sociales.id', '=', 'solicitudes.proyecto_social_id')
                ->join('peticiones', 'peticiones.id', '=', 'proyectos_sociales.peticion_id')
                ->join('tipos_servicio_social', 'tipos_servicio_social.id', '=', 'peticiones.tipo_servicio_social_id')
                ->join('instituciones', 'instituciones.id', '=', 'peticiones.institucion_id')
                ->join('estudiantes', 'estudiantes.id', '=', 'solicitudes.estudiante_id')
                ->where('solicitudes.estudiante_id', '=', $idEstudiante)
                ->where('solicitudes.estado_solicitud', '=', 'Aceptado')
                ->where(function($query){
                    $query->where('proyectos_sociales.estado_proyecto_social', '=', 'Finalizado')
                    ->orWhere('proyectos_sociales.estado_proyecto_social', '=', 'Cancelado');
                })
                ->get();

                return Inertia::render('Components/ServicioSocial/ListarServicioSocialEstudiante', ['servicio' => $servicioActivo, 'servicios' => $servicios]);
            } else if (Auth::user()->hasRole('Encargado Escuela')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el id del encargado logeado
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEncargado = $encargado->id;

                $servicios = ProyectoSocial::select('proyectos_sociales.id as id', 'cantidad_horas', 'estado_proyecto_social', 'cantidad_estudiantes', 
                'descripcion_peticion', 'ubicacion_actividades', 'fecha_peticion', 'fecha_peticion_fin', 'estado_proyecto_social', 
                'correo_peticion', 'nombre_carrera', 'nombre_tipo_servicio', 'nombre_facultad', 'nombre_institucion', 
                'contacto_institucion', 'correo_institucion', 'telefono_institucion', 'ubicacion_institucion', 
                'rubro_institucion')
                ->join('peticiones','proyectos_sociales.peticion_id', '=', 'peticiones.id')
                ->join('carreras', 'peticiones.carrera_id', '=', 'carreras.id')
                ->join('facultades', 'carreras.facultad_id', '=', 'facultades.id')
                ->join('tipos_servicio_social', 'peticiones.tipo_servicio_social_id', '=', 'tipos_servicio_social.id')
                ->join('instituciones', 'peticiones.institucion_id', '=','instituciones.id')
                ->where('peticiones.carrera_id', '=', $encargado->carrera_id)
                ->get();
                $tipos = TipoServicioSocial::select('nombre_tipo_servicio')->get();
                $carreras = Carrera::select('nombre_carrera')->get();            
                return Inertia::render('Components/ServicioSocial/ListarServicioSocial', ['servicios' => $servicios, 'tipos' => $tipos, 'carreras' => $carreras]);
            } else {

                $servicios = ProyectoSocial::select('proyectos_sociales.id as id', 'cantidad_horas', 'estado_proyecto_social', 'cantidad_estudiantes', 
                'descripcion_peticion', 'ubicacion_actividades', 'fecha_peticion', 'fecha_peticion_fin', 'estado_proyecto_social', 
                'correo_peticion', 'nombre_carrera', 'nombre_tipo_servicio', 'nombre_facultad', 'nombre_institucion', 
                'contacto_institucion', 'correo_institucion', 'telefono_institucion', 'ubicacion_institucion', 
                'rubro_institucion')
                ->join('peticiones','proyectos_sociales.peticion_id', '=', 'peticiones.id')
                ->join('carreras', 'peticiones.carrera_id', '=', 'carreras.id')
                ->join('facultades', 'carreras.facultad_id', '=', 'facultades.id')
                ->join('tipos_servicio_social', 'peticiones.tipo_servicio_social_id', '=', 'tipos_servicio_social.id')
                ->join('instituciones', 'peticiones.institucion_id', '=','instituciones.id')
                ->get();
                $tipos = TipoServicioSocial::select('nombre_tipo_servicio')->get();
                $carreras = Carrera::select('nombre_carrera')->get();            
                return Inertia::render('Components/ServicioSocial/ListarServicioSocial', ['servicios' => $servicios, 'tipos' => $tipos, 'carreras' => $carreras]);
            
            }
        } else {
            return Redirect::route('login');
        }

                    
    }

    public function serviciosDisponibles(){
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Estudiante')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el id del estudiante logeado
                $estudiante = Estudiante::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEstudiante = $estudiante->id;

                // consulta de tabla
                $solicitudes = DB::table('solicitudes')->select('proyecto_social_id')
                ->where('solicitudes.estudiante_id', '=', $idEstudiante)
                ->get();

                $servicios = ProyectoSocial::select('proyectos_sociales.id as id', 'nombre_peticion','cantidad_horas', 'estado_proyecto_social', 'cantidad_estudiantes', 
                'descripcion_peticion', 'ubicacion_actividades', 'fecha_peticion', 'fecha_peticion_fin', 'estado_proyecto_social', 
                'correo_peticion', 'nombre_carrera', 'nombre_tipo_servicio', 'nombre_facultad', 'nombre_institucion', 
                'contacto_institucion', 'correo_institucion', 'telefono_institucion', 'ubicacion_institucion', 
                'rubro_institucion')
                ->join('peticiones','proyectos_sociales.peticion_id', '=', 'peticiones.id')
                ->join('carreras', 'peticiones.carrera_id', '=', 'carreras.id')
                ->join('facultades', 'carreras.facultad_id', '=', 'facultades.id')
                ->join('tipos_servicio_social', 'peticiones.tipo_servicio_social_id', '=', 'tipos_servicio_social.id')
                ->join('instituciones', 'peticiones.institucion_id', '=','instituciones.id')
                ->where('proyectos_sociales.estado_proyecto_social', '=', 'No iniciado')
                ->where('peticiones.carrera_id', '=', $estudiante->carrera_id)
                ->get();
                $tipos = TipoServicioSocial::select('nombre_tipo_servicio')->get();
                $carreras = Carrera::select('nombre_carrera')->get();            
                return Inertia::render('Components/Solicitudes/ServiciosSocialesDisponibles', ['solicitudes' => $solicitudes, 'servicios' => $servicios, 'tipos' => $tipos, 'carreras' => $carreras, 'estudiante' => $estudiante]);
            }
        } else {
            return Redirect::route('login');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProyectoSocial  $proyectoSocial
     * @return \Illuminate\Http\Response
     */
    public function show($proyecto_social_id)
    {
        //
        if(Auth::check()){

            if(Auth::user()->hasRole('Encargado Escuela')){
                    // obteniendo el id del usuario logeado
                    $idUsuario = Auth::id();

                    $servicio = ProyectoSocial::select('proyectos_sociales.id as id', 'nombre_peticion','cantidad_horas', 'estado_proyecto_social', 'cantidad_estudiantes', 
                    'descripcion_peticion', 'ubicacion_actividades', 'fecha_peticion', 'fecha_peticion_fin', 'estado_proyecto_social', 
                    'correo_peticion', 'nombre_carrera', 'nombre_tipo_servicio', 'nombre_facultad', 'nombre_institucion', 
                    'contacto_institucion', 'correo_institucion', 'telefono_institucion', 'ubicacion_institucion', 
                    'rubro_institucion')
                    ->join('peticiones','proyectos_sociales.peticion_id', '=', 'peticiones.id')
                    ->join('carreras', 'peticiones.carrera_id', '=', 'carreras.id')
                    ->join('facultades', 'carreras.facultad_id', '=', 'facultades.id')
                    ->join('tipos_servicio_social', 'peticiones.tipo_servicio_social_id', '=', 'tipos_servicio_social.id')
                    ->join('instituciones', 'peticiones.institucion_id', '=','instituciones.id')
                    ->where('proyectos_sociales.id', '=', $proyecto_social_id)
                    ->first();
                    
                    // obteniendo el id del estudiante logeado
                    $estudiantes = DB::table('estudiantes')
                    ->join('bitacoras','bitacoras.estudiante_id', '=', 'estudiantes.id')
                    ->join('proyectos_sociales', 'proyectos_sociales.id', '=', 'bitacoras.proyecto_social_id')
                    ->join('carreras','carreras.id', '=', 'estudiantes.carrera_id')
                    ->join('facultades', 'facultades.id', '=', 'carreras.facultad_id')
                    ->where('proyectos_sociales.id', '=', $proyecto_social_id)
                    ->get();
                    //$idEstudiante = $estudiante->idE;
                    
                    return Inertia::render("Components/ServicioSocial/VerServicioSocial",['servicio' => $servicio, 'estudiantes' => $estudiantes, 'idServicio' => $proyecto_social_id]);

                }else{
                    return Redirect::route('dashboard');
                }

            }else{
            return Redirect::route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProyectoSocial  $proyectoSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(ProyectoSocial $proyectoSocial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProyectoSocial  $proyectoSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $proyecto_social_id)
    {
        //
        if(Auth::check()){

            if(Auth::user()->hasRole('Encargado Escuela')){
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();                
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->first();

                $servicio = ProyectoSocial::join('peticiones','proyectos_sociales.peticion_id', '=', 'peticiones.id')
                ->where('proyectos_sociales.id', '=', $proyecto_social_id)
                ->first();

                // obteniendo el id del estudiante logeado
                $estudiantes = DB::table('estudiantes')->select('estudiantes.id as id')
                ->join('bitacoras','bitacoras.estudiante_id', '=', 'estudiantes.id')
                ->join('proyectos_sociales', 'proyectos_sociales.id', '=', 'bitacoras.proyecto_social_id')
                ->where('proyectos_sociales.id', '=', $proyecto_social_id)
                ->get();

                //return $servicio->carrera_id;

                if ($encargado->carrera_id == $servicio->carrera_id){
                    if ($request->tipo=="finalizar"){
                        $serv = ProyectoSocial::find($proyecto_social_id);
                        $serv->estado_proyecto_social = 'Finalizado';
                        $serv->save();

                        foreach($estudiantes as $estudiante){
                            $estud = Estudiante::find($estudiante->id);
                            $estud->cantidad_horas_ss = $estud->cantidad_horas_ss + $servicio->cantidad_horas;
                            $estud->estado_estudiante = 'Activo';
                            $estud->save();
                        }
                    } else if ($request->tipo=="iniciar"){
                        $serv = ProyectoSocial::find($proyecto_social_id);
                        $serv->estado_proyecto_social = 'En curso';
                        $serv->save();

                        $solicitudes = DB::table('solicitudes')->select('solicitudes.id as id')->where('proyecto_social_id', '=', $proyecto_social_id)
                        ->where('estado_solicitud', '=', 'En espera')->get();

                        foreach($solicitudes as $solicitud){
                            $sol = Solicitud::find($solicitud->id);
                            $sol->estado_solicitud = 'Rechazado';
                            $sol->save();
                        }
                    }
                    

                    return redirect()->route('serviciossociales', ['proyecto_social_id' => $proyecto_social_id]);
                } else {
                    return "nop";
                }

            } else {
                return "escuela";
            }
        } else {
            return "acceso";
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProyectoSocial  $proyectoSocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProyectoSocial $proyectoSocial)
    {
        //
    }
}
