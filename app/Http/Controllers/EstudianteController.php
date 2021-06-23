<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Facultad;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $estudiantes = Estudiante::all();
        $estudiantes = Facultad::join('carreras', 'carreras.facultad_id', '=', 'facultades.id')
                                ->join('estudiantes', 'estudiantes.carrera_id', '=', 'carreras.id')
                                ->select('*')->get();
        // return $estudiantes;
       return Inertia::render('Components/ListarEstudiante', ['estudiantes' => $estudiantes]);
        // return "hola";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultades = Facultad::all();
        $carreras = Carrera::all();
        return Inertia::render('Components/FormEstudiante', ['facultades' => $facultades, 'carreras' => $carreras]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        Estudiante::create($request->all());
        return Redirect::route('dashboard');    
        // return Inertia::render('Welcome');
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

    // public function findCarrerasByFacultad(){
    //     $carreras = Carrera::where('facultad_id', 2)->get();
    //     return Inertia::render('FormEstudiante', ['carreras' => $carreras]);
    // }
}
