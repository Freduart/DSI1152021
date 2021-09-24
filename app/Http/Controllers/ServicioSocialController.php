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
                ->select('nombre_peticion as servicio', 'proyectos_sociales.id as idServicio', 'nombre_tipo_servicio as tipo', 'descripcion_peticion as descripcion', 'ubicacion_actividades', 'fecha_inicio as fechaInicio', 'fecha_fin as fechaFin', 'proyectos_sociales.numero_horas as numHoras', 'estado_proyecto_social as estado', 'nombre_institucion as institucion', 'rubro_institucion as rubro', 'contacto_institucion as contacto', 'correo_institucion as correo', 'telefono_institucion as telefono', 'ubicacion_institucion as ubicacion')
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
            } else {
                $servicios = ProyectoSocial::join('peticiones','proyectos_sociales.peticion_id', '=', 'peticiones.id')
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
    public function show(ProyectoSocial $proyectoSocial)
    {
        //
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
    public function update(Request $request, ProyectoSocial $proyectoSocial)
    {
        //
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
