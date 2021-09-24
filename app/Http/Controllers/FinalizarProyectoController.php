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



class FinalizarProyectoController extends Controller
{
    //
    public function index()
    {
        //$proyectos=ProyectoSocial::all(); 
        $proyectos = DB::table('proyectos_sociales')
        ->select('tipos_servicio_social.nombre_tipo_servicio as nombreTipo','carreras.nombre_carrera as nombre_carrera',
        'instituciones.nombre_institucion as nombreIns', 'proyectos_sociales.estado_proyecto_social as estadoP','instituciones.rubro_institucion as rubro',
        'instituciones.contacto_institucion as contactoIns','instituciones.correo_institucion as correoIns','instituciones.telefono_institucion as telIns',
        'instituciones.ubicacion_institucion as ubic','proyectos_sociales.fecha_inicio as fI', 'proyectos_sociales.fecha_fin as fF','peticiones.descripcion_peticion as dp',
        'peticiones.cantidad_estudiantes as cantE','proyectos_sociales.numero_horas as cantH','peticiones.ubicacion_actividades as ubicAc','facultades.nombre_facultad as nombreFa',
        'proyectos_sociales.id as idPro')
        ->join('peticiones','peticiones.id','=','proyectos_sociales.peticion_id')
        ->join('tipos_servicio_social','tipos_servicio_social.id','=','peticiones.tipo_servicio_social_id')
        ->join('carreras','carreras.id','=','peticiones.carrera_id')
        ->join('instituciones','instituciones.id','=','peticiones.institucion_id')
        ->join('facultades','facultades.id','=','carreras.facultad_id')
        ->where('proyectos_sociales.estado_proyecto_social','=','En curso')
        ->get();     
        return Inertia::render("Components/ServicioSocial/FinalizarProyectos",['proyectos' => $proyectos]);
    }

    public function update(Request $request, $proyectos)
    {
        $proyecto=ProyectoSocial::find($proyectos);
        //cambiamos el estado del proyecto
        $proyecto->estado_proyecto_social = "Finalizado";
        $data = $request->input();
        //Guardamos los cambios
        $proyecto->save();
        //retornamos a la vista de finalizar proyectos
        return Redirect::route('finproyecto.index');
    }
}
