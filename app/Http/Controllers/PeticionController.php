<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Facultad;
use App\Models\Institucion;
use App\Models\Peticion;
use App\Models\User;
use App\Models\ProyectoSocial;
use App\Models\TipoServicioSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Mail\CorreossInstitucionMailable;
use App\Mail\EvaluacionMailable;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PeticionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            if(Auth::user()->hasRole('Institucion')){
                $idUsuario = Auth::id();
                $UserInstitucion = User::where('id', '=', $idUsuario)->firstOrFail();
                $institucion = Institucion::where('user_id', '=', $UserInstitucion->id)->firstOrFail();
                $peticiones = Peticion::join('instituciones', 'peticiones.institucion_id', '=', 'instituciones.id')
                                        ->join('proyectos_sociales', 'proyectos_sociales.peticion_id', '=', 'peticiones.id')
                                        ->where('peticiones.institucion_id', '=', $institucion->id)
                                        ->get();
                // dd($peticiones);
                return Inertia::render('Components/Peticiones/PeticionesParaInstitucion', ['peticiones' => $peticiones, 'institucion' => $institucion]);
            }else{
                // Obteniendo las peticiones de servicio social
                $peticion=Peticion::join('carreras', 'peticiones.carrera_id', '=', 'carreras.id')
                ->join('tipos_servicio_social', 'peticiones.tipo_servicio_social_id', '=', 'tipos_servicio_social.id')
                ->join('instituciones', 'peticiones.institucion_id', '=', 'instituciones.id')
                ->where('estado_peticion', '=', 'En espera')
                ->select('peticiones.id AS idPeticion', 'cantidad_estudiantes', 'nombre_peticion', 'descripcion_peticion', 'ubicacion_actividades', 'fecha_peticion', 'fecha_peticion_fin', 'cantidad_horas', 'otros_tipo_servicio', 'estado_peticion', 'correo_peticion', 'carrera_id', 'nombre_carrera', 'tipo_servicio_social_id', 'nombre_tipo_servicio', 'institucion_id', 'nombre_institucion')
                ->get();
                $carreras= Carrera::all();
                return Inertia::render('Components/Peticiones/ListarPeticion',['peticiones' => $peticion, 'carreras' => $carreras]);
            }
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Crea el formulario para crear una peticion de servicio social        
        $peticion = new Peticion();
        $peticion->id = null;
        $peticion->nombre_peticion = '';
        $peticion->descripcion_peticion = '';
        $peticion->cantidad_estudiantes = '';
        $peticion->ubicacion_actividades = '';

        //Campos nuevos agregados
        $peticion->fecha_peticion = '';
        $peticion->fecha_peticion_fin = '';
        $peticion->cantidad_horas='';

        $peticion->otros_tipo_servicio = '';
        $peticion->estado_peticion = 'En espera';
        $peticion->correo_peticion = '';
        $peticion->carrera_id = '';
        $peticion->tipo_servicio_social_id = '';
        $peticion->institucion_id = '';
        
        //Info de los select
        $tipoServicioSociales = TipoServicioSocial::all();
        $instituciones = Institucion::all();
        $facultades = Facultad::all();

        //Dependencia de las carreras a partir de la facultad selccionada
        $carreras = DB::table('carreras')->distinct('nombre_carrera')        
        ->select('carreras.id AS idC', 'nombre_carrera', 'facultad_id')
        ->distinct('nombre_carrera')
        ->get();

        return Inertia::render('Components/Peticiones/FormPeticion',['peticiones' => $peticion, 'carreras' => $carreras, 'tipoServicios' => $tipoServicioSociales, 'instituciones' => $instituciones, 'facultades' => $facultades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtenemos la data del request
        // Agregamos la nueva peticion                
        Peticion::create($request->all());
        return Redirect::route("dashboard");
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
    public function edit($peticion)
    {
        // Obtenemos las carreras a partir de la facultad
        /*$carreras = DB::table('carreras')->distinct('nombre_carrera')        
        ->join('peticiones', 'carreras.id', '=', 'peticiones.carrera_id')
        ->select('carreras.id AS idC', 'nombre_carrera', 'facultad_id')
        ->where('peticiones.id', '=', $peticion)
        ->get();*/
        // Obtenemos la peticion 
        $peticionF = Peticion::find($peticion);

        //Info de los select
        $tipoServicioSociales = TipoServicioSocial::all();
        $instituciones = Institucion::all();
        

        //Dependencia de las carreras a partir de la facultad selccionada
        $carreras = DB::table('carreras')->distinct('nombre_carrera')        
        ->select('carreras.id AS idC', 'nombre_carrera', 'facultad_id')
        ->distinct('nombre_carrera')
        ->get();

        /* Obtenemos el tipo de servicio
        $tipoServicioSociales = DB::table('tipos_servicio_social')->distinct('nombre_tipo_servicio')
        ->join('peticiones', 'tipos_servicio_social.id','=','peticiones.tipo_servicio_social_id')
        ->select('tipos_servicio_social.id as idTS','nombre_tipo_servicio')
        ->where('peticiones.id', '=', $peticion)
        ->get();

        // Obtenemos la institucion 
        $institucion = DB::table('instituciones')->distinct('nombre_institucion')
        ->join('peticiones', 'instituciones.id','=','peticiones.institucion_id')
        ->select('instituciones.id as idIns','nombre_institucion')
        ->where('peticiones.id', '=', $peticion)
        ->get();*/

        // dd($peticionF);
        // Obtenemos la carrera 
        $facultades= Facultad::all();

        $carrera = Carrera::find($peticionF->carrera_id)->firstOrFail();
        $idFacultad = Facultad::find($carrera->facultad_id)->firstOrFail();

        // Renderizamos la vista para modificar la peticion
        return Inertia::render('Components/Peticiones/FormPeticion', ['carreras'=>$carreras, 'peticiones' => $peticionF, 'tipoServicios' => $tipoServicioSociales, 'instituciones' => $instituciones, 'facultades'=> $facultades, 'idFacultad'=> $idFacultad]);   // 'idFacultad'=> $idFacultad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $peticion)
    {   
        // return $request->all();
        $peticion = Peticion::find($peticion);
        $peticion -> update($request -> all());
        // if(Auth::user()->hasRole('Institucion')){
        //     return Redirect::route('peticiones.index');
        // }
        return Redirect::route('peticiones.index');
    }

    public function updateStatus($peticion)
    {
        $peticionF= Peticion::find($peticion);
        $peticionF->estado_peticion = "Aceptado";
        $peticionF->save(); 
        //envio de correo
        //details es un array que contiene las variables que se van a renderizar en la vista del correo
        $details = [            
            'proyecto' => $peticionF->nombre_peticion,
            'estado' => $peticionF->estado_peticion,
            'mensaje' => 'Su solicitud de registro de proyecto en el sistema SASS-UES ha sido ACEPTADA',
        ];
        //Se crea un objeto correo de tipo CredencialesMailable para el envio de correo de credenciales
        //Se debe crear otra clase de tipo Mailable si se quiere crear un correo que sirva para otra cosa
        $correo = new CorreossInstitucionMailable($details);
        //Se envía el correo, con la dirección de la institucion
        Mail::to($peticionF->correo_peticion)
              ->send($correo);      

        // $usuario = User::where('email', '=', $data['correo_peticion'])->firstOrFail();
        // $id = $usuario->id;

        // $institucion = Institucion::where('correo_institucion', '=', $data['correo_peticion'])->firstOrFail();        
        
        // $institucion->user_id = $id;
        // $institucion->save();
        

        
        ProyectoSocial::create([
            'estado_proyecto_social' => 'No iniciado',
            'peticion_id' => $peticionF->id,  
        ]);        

        return Redirect::route('peticiones.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($peticion)
    {
        //Aca se debe cambiar el estado de las peticiones de servicio social 
        $peticionF = Peticion::find($peticion);
        $peticionF->estado_peticion = "Rechazado";
        $peticionF->save();  


        $details = [            
            'proyecto' => $peticionF->nombre_peticion,
            'estado' => $peticionF->estado_peticion,
            'mensaje' => 'Su solicitud de registro de proyecto en el sistema SASS-UES ha sido RECHAZADA',
        ];
        //Se crea un objeto correo de tipo CredencialesMailable para el envio de correo de credenciales
        //Se debe crear otra clase de tipo Mailable si se quiere crear un correo que sirva para otra cosa
        $correo = new CorreossInstitucionMailable($details);
        //Se envía el correo, con la dirección de la institucion
        Mail::to($peticionF->correo_peticion)
              ->send($correo); 

        return Redirect::route('peticiones.index');
    }
}
