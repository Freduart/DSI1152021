<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Facultad;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            if(Auth::user()->hasRole('Administrador')){
                $carreras = Facultad::join('carreras', 'carreras.facultad_id', '=', 'facultades.id')
                ->select('*')->get();
                $facultades = Facultad::all();
                return Inertia::render('Components/Carreras', ['carreras' => $carreras, 'facultades' => $facultades]);        
            }else{
                return Redirect::route('dashboard');
            }
        }else{
            return Redirect::route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "hola";
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
        Carrera::create($request->all());
        return Redirect::route('carreras.index');
        // return Inertia::render('Components/Carreras');
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
        $estadoCliente = $request->estado_carrera;
        // return $estadoCliente;
        $carrera = Carrera::find($id);
        // return $carrera->estado_carrera;
        $estadoServidor = $carrera->estado_carrera;
        // return $estadoServidor;
        if($estadoCliente == $estadoServidor){
            // return "No cambia";
            $carrera->update($request->all());
        }
        else{
            // return "Cambia";
            $carrera->estado_carrera = $estadoCliente;
            $carrera->save();
        }
        return Redirect::route('carreras.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return "borrado " + $id;
        $carrera = Carrera::find($id);
        $carrera->delete();
        return Redirect::route('carreras.index');
    }
}
