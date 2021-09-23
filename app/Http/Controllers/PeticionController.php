<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Institucion;
use App\Models\Peticion;
use App\Models\TipoServicioSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    }
}
