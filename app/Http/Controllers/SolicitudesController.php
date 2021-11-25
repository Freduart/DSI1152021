<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\EncargadoEscuela;
use App\Models\Bitacora;
use App\Http\Controllers\Controller;
use App\Mail\EvaluacionMailable;
use Illuminate\Support\Facades\Mail;

class SolicitudesController extends Controller
{
    //
    public function index()
    {
        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Encargado Escuela')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el id del encargado logeado
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEncargado = $encargado->id;

                 //Trae datos de la tabla solicitudes y estudiantes
                $solicitudes = DB::table('solicitudes')
                ->select('solicitudes.id', 'estudiantes.carnet_estudiante', 'estudiantes.nombre_estudiante', 'estudiantes.apellido_estudiante','solicitudes.fecha_solicitud', 'solicitudes.estado_solicitud', 'solicitudes.justificacion_solicitud')
                ->join('estudiantes', 'estudiantes.id', '=', 'solicitudes.estudiante_id')
                ->where('solicitudes.estado_solicitud', '=', 'En Espera','OR','solicitudes.estado_solicitud', '=', 'Rechazado')
                ->where('estudiantes.carrera_id', '=', $encargado->carrera_id)
                ->get();

                return Inertia::render("Components/EvaluarSolicitudes/Solicitudes",['solicitudes' => $solicitudes]);
                
            } else {
                return Redirect::route('dashboard');
                    }
        } else {
            return Redirect::route('login');
        }
       

    }

    public function destroy(Request $request, $solicitud)
    {
        $solicitudE=Solicitud::find($solicitud);
        $solicitudE->estado_solicitud = "Rechazado";
        $data = $request->input();
        $solicitudE->save();
        /*$solicitudE->delete();*/

        $estudiante = Estudiante::find($solicitudE->estudiante_id);
        $estudiante->estado_estudiante= "Activo";
        $estudiante->save();

        // Envio de correos
        $details = [
            // 'proyecto' =>$proyecto[0],
            'usuario' => $estudiante->correo_estudiante,
            'mensaje' => 'Su solicitud para participar en un el servicio social deseado ha sido RECHAZADA',
        ];

        // Se crea el nuevo objeto para enviar el correo al estudiante
        $correo = new EvaluacionMailable($details);        
        Mail::to($estudiante->correo_estudiante)
            ->send($correo);

        return Redirect::route('solicitudes.index');
    }

    public function update(Request $request, $solicitud)
    {
        $solicitudE=Solicitud::find($solicitud);
        //$solicitudE->estado_solicitud = "Aprobado";
        $solicitudE->estado_solicitud = "Aceptado";
        $data = $request->input();
        $solicitudE->save();

        
        $bitacora = new Bitacora();
        $bitacora->estudiante_id = $solicitudE->estudiante_id;
        $bitacora->proyecto_social_id = $solicitudE->proyecto_social_id;
        $bitacora->total_horas = 0;
        $bitacora->save();

        $estudiante = Estudiante::find($solicitudE->estudiante_id);
        $estudiante->estado_estudiante= "Realizando servicio";
        $estudiante->save();
        

        // dd($proyecto);

        // Envio de correo cuando se acepta su peticion de servicio social
        $details = [
            // 'proyecto' =>$proyecto[0],
            'usuario' => $estudiante->correo_estudiante,
            'mensaje' => 'Su solicitud para participar en el servicio social ha sido ACEPTADA',
        ];

        // Se crea el nuevo objeto para enviar el correo al estudiante
        $correo = new EvaluacionMailable($details);        
        Mail::to($estudiante->correo_estudiante)
            ->send($correo);

        return Redirect::route('solicitudes.index');

    }
}
