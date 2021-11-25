<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\ProyectoSocial;
use App\Models\Estudiante;
use App\Models\EncargadoEscuela;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mail\ServicioFinalizadoMailable;
use Illuminate\Support\Facades\Mail;



class FinalizarServicioController extends Controller
{
    //
    public function index()
    {
        //$proyectos=ProyectoSocial::all(); 
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Encargado Escuela')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el id del encargado logeado
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEncargado = $encargado->id;

                $estudiantes = Estudiante::join('carreras', 'carreras.id', '=', 'estudiantes.carrera_id')
                ->select('estudiantes.id as id','nombre_estudiante','apellido_estudiante','apellido_estudiante','correo_estudiante','telefono_estudiante','sexo_estudiante','dui_estudiante','nit_estudiante','materias_cursadas','cantidad_horas_ss','nombre_facultad','nombre_carrera','estado_estudiante','carnet_estudiante','porcentaje_aprobacion',)
                ->join('facultades','facultades.id','=','carreras.facultad_id')
                ->where('cantidad_horas_ss', '>=', 500)
                ->where('carrera_id', '=',$encargado->carrera_id)
                ->Where('estado_estudiante', '=', 'Activo')
                ->get();

                return Inertia::render("Components/ServicioSocial/FinalizarServicio",['estudiantes' => $estudiantes]);
            }
        }
        
    }

    public function update(Request $request, $id_estudiante)
    {
        $estudiante=Estudiante::find($id_estudiante);
        //cambiamos el estado del proyecto
        $estudiante->estado_estudiante = "Servicio finalizado";
        //Guardamos los cambios
        if($estudiante->save()){
            //envio de correo
            $details = [
                'nombres' => $estudiante->nombre_estudiante,
                'apellidos' => $estudiante->apellido_estudiante,
                'horas' => $estudiante->cantidad_horas_ss,
            ];

            $correo = new ServicioFinalizadoMailable($details);
            Mail::to($estudiante->correo_estudiante)->send($correo);       
        }

        //retornamos a la vista de finalizar proyectos
        return Redirect::route('serviciofinalizado.index');
    }
}
