<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Facultad;
use App\Models\EncargadoEscuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EncargadoEscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT DISTINCT nombre_facultad, estado_encargado_escuela 
        //FROM facultades, carreras, encargado_escuelas WHERE facultades.id = carreras.facultad_id 
        //AND encargado_escuelas.carrera_id = carreras.id
        $encargadosEscuela = DB::table('encargado_escuelas')
        ->join('carreras', 'encargado_escuelas.carrera_id', '=', 'carreras.id')
        ->join('facultades', 'carreras.facultad_id', '=', 'facultades.id')
        ->select('encargado_escuelas.id AS idEncargado', 'codigo_encargado_escuela', 'dui_encargado_escuela', 'nombre_encargado_escuela', 'apellido_encargado_escuela', 'correo_encargado_escuela', 'telefono_encargado_escuela', 'estado_encargado_escuela', 'nombre_facultad', 'facultad_id', 'nombre_carrera', 'carrera_id')
        ->get();
        $facultades = DB::table('facultades')->distinct('nombre_facultad')
        ->join('carreras', 'facultades.id', '=', 'carreras.facultad_id')
        ->join('encargado_escuelas', 'carreras.id', '=', 'encargado_escuelas.carrera_id')
        ->select('nombre_facultad', 'estado_encargado_escuela')
        //->groupBy('nombre_facultad')
        ->get();
        $carreras = Carrera::all();
        return Inertia::render('Components/ListarEncargadoEscuela', ['encargadosE' => $encargadosEscuela, 'facultades' => $facultades, 'carreras' => $carreras]);
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
     * @param  \App\Models\EncargadoEscuela  $encargadoEscuela
     * @return \Illuminate\Http\Response
     */
    public function show(EncargadoEscuela $encargadoEscuela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EncargadoEscuela  $encargadoEscuela
     * @return \Illuminate\Http\Response
     */
    public function edit(EncargadoEscuela $encargadoEscuela)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EncargadoEscuela  $encargadoEscuela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EncargadoEscuela $encargadoEscuela)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EncargadoEscuela  $encargadoEscuela
     * @return \Illuminate\Http\Response
     */
    public function destroy(EncargadoEscuela $encargadoEscuela)
    {
        //
    }
}
