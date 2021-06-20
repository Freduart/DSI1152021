<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Facultad;
use App\Models\EncargadoEscuela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

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
        $encargadoE = new EncargadoEscuela();
        $encargadoE->id = null;
        $encargadoE->codigo_encargado_escuela = '';
        $encargadoE->nombre_encargado_escuela = '';
        $encargadoE->apellido_encargado_escuela = '';
        $encargadoE->correo_encargado_escuela = '';
        $encargadoE->carrera_id = '';
        $encargadoE->estado_encargado_escuela = 'Activo';
        $encargadoE->user_id = null;
        $encargadoE->dui_encargado_escuela = '';
        $encargadoE->telefono_encargado_escuela = '';
        $facultades = Facultad::all();
        $carreras = Carrera::all();
        return Inertia::render('Components/FormEncargadoEscuela', ['encargadoE' => $encargadoE,'facultades' => $facultades, 'carreras' => $carreras]);
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
        EncargadoEscuela::create($request->all());
        return Redirect::route('encargadosescuela.index');  
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
    public function edit($encargadoEscuela)
    {
        //
        $facultades = Facultad::all();
        $encargadoE = EncargadoEscuela::find($encargadoEscuela);
        $idCarrera = $encargadoE->carrera_id;
        $carreraEncargado = Carrera::find($idCarrera);
        $idFacultad = $carreraEncargado->facultad_id;
        $carreras = Carrera::all();
        return Inertia::render('Components/FormEncargadoEscuela', ['encargadoE' => $encargadoE, 'facultades' => $facultades, 'carreras' => $carreras, 'idFacultad' => $idFacultad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EncargadoEscuela  $encargadoEscuela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encargadoEscuela)
    {
        //
        $encargadoE = EncargadoEscuela::find($encargadoEscuela);
        $encargadoE->update($request->all());
        return Redirect::route('encargadosescuela.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EncargadoEscuela  $encargadoEscuela
     * @return \Illuminate\Http\Response
     */
    public function destroy($encargadoEscuela)
    {
        //
        $encargadoE = EncargadoEscuela::find($encargadoEscuela);
        if ($encargadoE->estado_encargado_escuela == "Activo"){
            $encargadoE->estado_encargado_escuela = "Inactivo";
            $encargadoE->save();
        } else {
            $encargadoE->estado_encargado_escuela = "Activo";
            $encargadoE->save();
        }
             
        //$encargadoF->delete();
        return Redirect::route('encargadosescuela.index');
    }
}
