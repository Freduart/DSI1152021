<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Bitacora;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\EncargadoEscuela;
use Illuminate\Support\Facades\DB;

class VerificarActividadesController extends Controller
{
    //
    public function index()
    {
        
    

    }

    public function actividades($proyecto_social_id, $estudiante_id){
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Encargado Escuela')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();
        
                // obteniendo el id del encargado logeado
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->firstOrFail();
                $idEncargado = $encargado->id;

                // dd($encargado);

                // obteniendo el id del estudiante logeado
                $estudiante = DB::table('estudiantes')->select('estudiantes.id as idE', 'nombre_facultad', 'nombre_carrera', 'carnet_estudiante', 'nombre_estudiante', 'apellido_estudiante')
                ->join('carreras','carreras.id', '=', 'estudiantes.carrera_id')
                ->join('facultades', 'facultades.id', '=', 'carreras.facultad_id')
                ->where('estudiantes.id', '=', $estudiante_id)
                ->first();

                // 
                $proyecto = DB::table('proyectos_sociales')
                ->select('nombre_peticion', 'nombre_institucion', 'proyectos_sociales.id as idServicio', 'nombre_tipo_servicio', 'estado_proyecto_social', 'estado_bitacora')
                ->join('peticiones','peticiones.id','=','proyectos_sociales.peticion_id')
                ->join('instituciones','instituciones.id','=','peticiones.institucion_id')
                ->join('tipos_servicio_social','tipos_servicio_social.id','=','peticiones.tipo_servicio_social_id')
                ->join('bitacoras','bitacoras.proyecto_social_id','=','proyectos_sociales.id')
                ->join('estudiantes','bitacoras.estudiante_id','=','estudiantes.id')
                //->join('actividades','bitacoras.id','=','actividades.bitacora_id')
                //->where('proyectos_sociales.estado_proyecto_social', '=', 'En curso')
                ->where('peticiones.carrera_id', '=', $encargado->carrera_id)
                ->where('proyectos_sociales.id', '=', $proyecto_social_id)
                ->where('estudiantes.id', '=', $estudiante_id)
                ->first();

                // dd($proyecto);

                // se obtienen todos los campos de tabla actividad
                $actividades = DB::table('actividades')->orderBy('idE')
                ->select('estudiantes.id as idE','nombre_estudiante','apellido_estudiante','actividades.id as id', 'nombre_actividad', 'fecha_actividad', 'verificado', 'actividades.total_horas as total_horas', 'proyectos_sociales.id as idServicio', 'observaciones_actividad' )
                ->join('bitacoras','bitacoras.id','=','actividades.bitacora_id')
                ->join('estudiantes','estudiantes.id','=','bitacoras.estudiante_id')
                ->join('proyectos_sociales','proyectos_sociales.id','=','bitacoras.proyecto_social_id')
                //->where('verificado', '=', 'En espera')
                ->where('estudiantes.carrera_id', '=', $encargado->carrera_id)
                ->where('estudiantes.id', '=', $estudiante_id)
                ->where('proyectos_sociales.id', '=', $proyecto_social_id)
                ->get();

                return Inertia::render("Components/VerificarActividades/VerificarActividades",['actividades' => $actividades, 'proyecto' => $proyecto, 'estudiante' => $estudiante]);
                
            } else {
                return Redirect::route('dashboard');
            }
        } else {
            return Redirect::route('login');
        }
    }

    public function update(Request $request, $actividad_id)
    {
        if($request->verificado == 'Aceptadas'){
            $actividades = DB::table('actividades')->select('actividades.id as id')
            ->join('bitacoras','bitacoras.id','=','actividades.bitacora_id')
            ->join('estudiantes','estudiantes.id','=','bitacoras.estudiante_id')
            ->join('proyectos_sociales','proyectos_sociales.id','=','bitacoras.proyecto_social_id')
            ->where('estudiantes.id', '=', $request->estudiante_id)
            ->where('proyectos_sociales.id', '=', $request->proyecto_social_id)
            ->get();

            foreach($actividades as $actividad){
                $act = Actividad::find($actividad->id);
                $act->verificado = "Aceptada";
                $act->observaciones_actividad = null;
                $act->save();
            }

        } else if($request->verificado == 'Finalizadas'){
            $bitacora = Bitacora::where('estudiante_id', '=' , $request->estudiante_id)
            ->where('proyecto_social_id','=', $request->proyecto_social_id)->first();
            $idBitacora = $bitacora->id;

            $actividades = Actividad::where('bitacora_id', '=', $idBitacora)
            ->where('verificado', '=', 'Aceptada')->get();
            $total_horas = 0;
            foreach($actividades as $actividad){
                $act = Actividad::find($actividad->id);
                $total_horas += $act->total_horas;
            }

            $bitacora->estado_bitacora = "Finalizado";
            $bitacora->total_horas = $total_horas;
            $bitacora->save();

        } else {
            //utilizamos el método update para cambiar la verificación
            $actividad=Actividad::find($actividad_id);
            //cambiamos el estado de la actividad
            $actividad->verificado = $request->verificado;
            if($request->verificado  == 'Aceptada') {
                $actividad->observaciones_actividad = null;
            } else {
                $actividad->observaciones_actividad = $request->observaciones_actividad;
            }
            //Guardamos los cambios
            $actividad->save();
        }

        

        // return $actividades;
        //              $bitacora = Bitacora::find($actividad->bitacora_id)->first();
        // return $bitacora->total_horas;
        // $bitacora->total_horas += $bitacora->total_horas + floor(($actividad->total_horas)/2)+1;
        /*              $bitacora->total_horas += $actividad->total_horas;
                        $bitacora->total_horas = floor($bitacora->total_horas/2);
                        $bitacora->save(); */
        // return $bitacora->estudiante_id;
        // $idEstudiante = Bitacora::find($bitacora->id)->firstOrFail();
        // return $idEstudiante;
        // $estudiante = Estudiante::where('id',$bitacora->estudiante_id)->firstOrFail();
        // return $estudiante;

        // $estudiante->cantidad_horas_ss += $actividad->total_horas;
        // return $actividad;
        // $estudiante->save();
        //retornamos a la view de verificar actividades
        
        //return Redirect::route('verificaractividades.index');
        return redirect()->route('actividadesestudiante', ['proyecto_social_id' => $request->proyecto_social_id, 'estudiante_id' => $request->estudiante_id]);
    }

    public function reportado(Request $request, $actividades)
    {
        //utilizamos el método update para cambiar la verificación
        $actividad=Actividad::find($actividades);
        //cambiamos el verificado a Aceptada
        $actividad->verificado = "Reportada";
        //Guardamos los cambios
        $actividad->save();

        return redirect()->route('serviciossociales', ['proyecto_social_id' => $request->proyecto_social_id, 'estudiante_id' => $request->estudiante_id]);
    }

    public function destroy(Request $request, $actividades)
    {
        //utilizamos el método update para cambiar la verificación
        $actividad=Actividad::find($actividades);
        //cambiamos el verificado a Reportada
        $actividad->verificado = "Reportada";
        // $contra = "adminadmin";
        $data = $request->input();
        //se guardan los cambios
        $actividad->save();
        //retornamos a la view de verificar actividades
        return Redirect::route('verificaractividades.index');
    }
}
