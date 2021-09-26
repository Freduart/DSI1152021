<?php

namespace App\Http\Controllers;

use App\Models\ProyectoSocial;
use App\Models\TipoServicioSocial;
use App\Models\Carrera;
use App\Models\Institucion;
use App\Models\Peticion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\EncargadoEscuela;

class EstablecerHAController extends Controller
{
    public function index(){
        //Metodo que muestra los campos de Institucion el tipo de servicio social y carreras

        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Encargado Escuela')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el id del encargado logeado
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEncargado = $encargado->id;

                $servicios=DB::table('proyectos_sociales')
                ->select('proyectos_sociales.id as idServicio','proyectos_sociales.peticion_id as idPeticion','peticiones.cantidad_estudiantes as cantidad','instituciones.nombre_institucion as institucion',
                'tipos_servicio_social.nombre_tipo_servicio as tipo',
                'carreras.nombre_carrera as carrera','proyectos_sociales.numero_horas as horas','proyectos_sociales.estado_proyecto_social as estado')
                ->join('peticiones','peticiones.id','=','proyectos_sociales.peticion_id')
                ->join('instituciones','instituciones.id','=','peticiones.institucion_id')
                ->join('tipos_servicio_social','tipos_servicio_social.id','peticiones.tipo_servicio_social_id')
                ->join('carreras','carreras.id','=','peticiones.carrera_id')
                ->where('proyectos_sociales.estado_proyecto_social','=','No iniciado')
                ->where('carreras.id', '=', $encargado->carrera_id)
                ->get();
                
            } else {
                return Redirect::route('dashboard');
                    }
        } else {
            return Redirect::route('login');
        }

        

             return Inertia::render('Components/EstablecerH-A/EstablecerHA', ['servicios' => $servicios]);            
        }
    
    public function update(Request $request, $servicio)
    {
        //Actualiza el campo de numero_horas en la DB
        $servicios=ProyectoSocial::find($servicio);
        $servicios->numero_horas=$request->horas;
        $servicios->save();
        
        //Actualiza el campo de cantidad_estudiantes en la DB
        $peticiones=Peticion::find($request->idPeticion);
        $peticiones->cantidad_estudiantes=$request->cantidad;
        $peticiones->save();

        return Redirect::route('establecerha.index');
    }
}