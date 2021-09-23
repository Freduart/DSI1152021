<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Facultad;
use App\Models\Institucion;
use App\Models\Peticion;
use App\Models\TipoServicioSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PeticionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // Obteniendo las peticiones de servicio social
        $peticion=Peticion::join('carreras', 'peticiones.carrera_id', '=', 'carreras.id')
        ->join('tipos_servicio_social', 'peticiones.tipo_servicio_social_id', '=', 'tipos_servicio_social.id')
        ->join('instituciones', 'peticiones.institucion_id', '=', 'instituciones.id')
        ->select('peticiones.id AS idPeticion', 'cantidad_estudiantes', 'nombre_peticion', 'descripcion_peticion', 'ubicacion_actividades', 'fecha_peticion', 'otros_tipo_servicio', 'estado_peticion', 'correo_peticion', 'carrera_id', 'nombre_carrera', 'tipo_servicio_social_id', 'nombre_tipo_servicio', 'institucion_id', 'nombre_institucion')
        ->get();
        $carreras= Carrera::all();
        return Inertia::render('Components/Peticiones/ListarPeticion',['peticiones' => $peticion, 'carreras' => $carreras]);

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
        $peticion->fecha_peticion = '';
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
    public function destroy($peticion)
    {
        //Aca se debe cambiar el estado de las peticiones de servicio social 
        $peticionF = Peticion::find($peticion);
        if($peticionF->estado_peticion=="En Espera"){
            $peticionF->estado_peticion = "Aceptado";
            $peticionF->save();
        }else{
            if($peticionF->estado_peticion=="Aceptado"){
                $peticionF->estado_peticion="Rechazado";
                $peticionF->save();
            }
        }

        return Redirect::route('peticiones.index');
    }
}
