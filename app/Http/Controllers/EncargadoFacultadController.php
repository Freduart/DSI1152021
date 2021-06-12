<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EncargadoFacultad;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EncargadoFacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$encargadoFacultad = EncargadoFacultad::all();
        /*$encargadoFacultad = DB::table('encargado_facultads')
        ->join('carreras', 'encargado_facultads.carrera_id', '=', 'carreras.id')
        ->join('personas', 'encargado_facultads.persona_id', '=', 'personas.id')
        ->get();*/
        $encargadoFacultad = EncargadoFacultad::join('facultades', 'encargado_facultades.facultad_id', '=', 'facultades.id')
        ->select('encargado_facultades.id AS idEncargado', 'codigo_encargado_facultad', 'nombre_encargado_facultad', 'apellido_encargado_facultad', 'correo_encargado_facultad', 'telefono_encargado_facultad', 'estado_encargado_facultad', 'nombre_facultad')->get();
        return Inertia::render('Components/ListarEncargadoFacultad', ['encargadosF' => $encargadoFacultad]);
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
     * @param  \App\Models\EncargadoFacultad  $encargadoFacultad
     * @return \Illuminate\Http\Response
     */
    public function show(EncargadoFacultad $encargadoFacultad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EncargadoFacultad  $encargadoFacultad
     * @return \Illuminate\Http\Response
     */
    public function edit(EncargadoFacultad $encargadoFacultad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EncargadoFacultad  $encargadoFacultad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EncargadoFacultad $encargadoFacultad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EncargadoFacultad  $encargadoFacultad
     * @return \Illuminate\Http\Response
     */
    public function destroy(EncargadoFacultad $encargadoFacultad)
    {
        //
    }
}
