<?php

namespace App\Http\Controllers;

use App\Models\Peticion;
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

        error_log("Bienvenido al controlador de Peticiones");
        //
        // $peticion=DB::table('peticiones');  
        return Inertia::render('Components/Peticion/ListarPeticion');

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
        $peticion = new Peticion([
            'cantidad_estudiantes' => $request->input('cantidad_estudiantes'),
            'descripcion_peticion' => $request->input('descripcion_peticion'),
            'ubicacion_actividades' => $request->input('ubicacion_actividades'),
            'fecha_peticion' => $request->dateinput('fecha_peticion'),
            'otros_tipo_servicio' => $request->input('otros_tipo_servicio'),
            'estado_peticion' => $request->input('estado_peticion'),
            'correo_peticion' => $request->emailinput('correo_peticion'),
            //Foraneas
            'carrera_id',
            'tipo_servicio_social_id',
            'institucion_id',
        ]);

        $peticion->save();
        Redirect::route('peticion.index');
        return response()->console.log("Peticion creada: "+$peticion);
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
