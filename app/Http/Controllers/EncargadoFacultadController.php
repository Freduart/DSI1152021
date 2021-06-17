<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EncargadoFacultad;
use App\Models\Facultad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        $facultades = Facultad::all();
        $encargadoFacultad = EncargadoFacultad::join('facultades', 'encargado_facultades.facultad_id', '=', 'facultades.id')
        ->select('encargado_facultades.id AS idEncargado', 'codigo_encargado_facultad', 'dui_encargado_facultad', 'nombre_encargado_facultad', 'apellido_encargado_facultad', 'correo_encargado_facultad', 'telefono_encargado_facultad', 'estado_encargado_facultad', 'nombre_facultad', 'facultad_id')->get();
        return Inertia::render('Components/ListarEncargadoFacultad', ['encargadosF' => $encargadoFacultad, 'facultades' => $facultades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $encargadoF = new EncargadoFacultad();
        $encargadoF->id = null;
        $encargadoF->codigo_encargado_facultad = '';
        $encargadoF->nombre_encargado_facultad = '';
        $encargadoF->apellido_encargado_facultad = '';
        $encargadoF->correo_encargado_facultad = '';
        $encargadoF->facultad_id = '';
        $encargadoF->estado_encargado_facultad = 'Activo';
        $encargadoF->user_id = null;
        $encargadoF->dui_encargado_facultad = '';
        $encargadoF->telefono_encargado_facultad = '';
        $facultades = Facultad::all();
        return Inertia::render('Components/FormEncargadoFacultad', ['encargadoF' => $encargadoF,'facultades' => $facultades]);
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
        EncargadoFacultad::create($request->all());
        return Redirect::route('encargadosfacultad.index');  
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
        $encargadoF = EncargadoFacultad::find($encargadoFacultad);
        return Inertia::render('encargadosfacultad.index', ['encargadoinfo' => $encargadoF]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EncargadoFacultad  $encargadoFacultad
     * @return \Illuminate\Http\Response
     */
    public function edit($encargadoFacultad)
    {
        //
        $facultades = Facultad::all();
        $encargadoF = EncargadoFacultad::find($encargadoFacultad);
        return Inertia::render('Components/FormEncargadoFacultad', ['encargadoF' => $encargadoF, 'facultades' => $facultades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EncargadoFacultad  $encargadoFacultad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encargadoFacultad)
    {
        //
        $encargadoF = EncargadoFacultad::find($encargadoFacultad);
        $encargadoF->update($request->all());
        return Redirect::route('encargadosfacultad.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EncargadoFacultad  $encargadoFacultad
     * @return \Illuminate\Http\Response
     */
    public function destroy($encargadoFacultad)
    {
        //
        /*$encargadoFacultad->estado_encargado_facultad = "Inactivo";
        $encargadoFacultad->save();*/
        $encargadoF = EncargadoFacultad::find($encargadoFacultad);
        if ($encargadoF->estado_encargado_facultad == "Activo"){
            $encargadoF->estado_encargado_facultad = "Inactivo";
            $encargadoF->save();
        } else {
            $encargadoF->estado_encargado_facultad = "Activo";
            $encargadoF->save();
        }
             
        //$encargadoF->delete();
        return Redirect::route('encargadosfacultad.index');
    }
}
