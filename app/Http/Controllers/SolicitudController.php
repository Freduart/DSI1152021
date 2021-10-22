<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Estudiante;
use App\Models\Solicitud;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Estudiante')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el id del estudiante logeado
                $estudiante = Estudiante::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEstudiante = $estudiante->id;

                // consulta de tabla
                $solicitudes = DB::table('solicitudes')
                ->select('solicitudes.id as idSolicitud', 'peticiones.descripcion_peticion as descripcion', 'peticiones.nombre_peticion as servicio','tipos_servicio_social.nombre_tipo_servicio as tipo', 'instituciones.nombre_institucion as institucion', 'instituciones.rubro_institucion as rubro','instituciones.ubicacion_institucion as ubicacion', 'estudiantes.nombre_estudiante as nombreEstudiante', 'estudiantes.apellido_estudiante as apellidoEstudiante','solicitudes.fecha_solicitud as fecha', 'solicitudes.estado_solicitud as estado', 'solicitudes.justificacion_solicitud as justificacion')
                ->join('proyectos_sociales', 'proyectos_sociales.id', '=', 'solicitudes.proyecto_social_id')
                ->join('peticiones', 'peticiones.id', '=', 'proyectos_sociales.peticion_id')
                ->join('tipos_servicio_social', 'tipos_servicio_social.id', '=', 'peticiones.tipo_servicio_social_id')
                ->join('instituciones', 'instituciones.id', '=', 'peticiones.institucion_id')
                ->join('estudiantes', 'estudiantes.id', '=', 'solicitudes.estudiante_id')
                ->where('solicitudes.estudiante_id', '=', $idEstudiante)
                ->get();
                return Inertia::render('Components/Solicitudes/SolicitudesEstudiante', ['solicitudes' => $solicitudes]);
            } else {
                return Redirect::route('dashboard');
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
        $solicitud = new Solicitud();
        $solicitud->estudiante_id = $request->estudiante_id;
        $solicitud->proyecto_social_id = $request->proyecto_social_id;
        $solicitud->fecha_solicitud = $request->fecha_solicitud;
        $solicitud->justificacion_solicitud = $request->justificacion_solicitud;
        $solicitud->estado_solicitud = $request->estado_solicitud;
        $solicitud->save();

        return Redirect::route('serviciosDisponibles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Estudiante')) {

                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el id del estudiante logeado
                $estudiante = Estudiante::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEstudiante = $estudiante->id;

                // obteniendo la solicitud a eliminar
                $solicitud=Solicitud::find($id);

                // comparando el estudiante registrado con el dueño de la solicitud
                if($solicitud->estudiante_id == $idEstudiante){
                    $solicitud->delete();
                }
            }
        }
        return "<script>alert('Sipi');</script>";
    }
}
