<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EncargadoEscuela;
use App\Models\EncargadoFacultad;
use App\Models\Facultad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
      $encargadoF->dui_encargado_facultad = '';
      $encargadoF->telefono_encargado_facultad = '';
      //$facultades = Facultad::all();
      $facultades = DB::table('facultades')->distinct('nombre_facultad')
        ->select('facultades.id AS idF', 'nombre_facultad')
        ->whereNotIn('nombre_facultad', DB::table('encargado_facultades')
        ->select('nombre_facultad')
        ->distinct('nombre_facultad')
        ->join('facultades', 'encargado_facultades.facultad_id', '=', 'facultades.id')
        ->where('estado_encargado_facultad', '=', 'Activo'))
        ->get();
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
      //EncargadoFacultad::create($request->all());
      /*$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
      $contra = substr(str_shuffle($permitted_chars), 0, 10);*/
      $contra = "adminadmin";

      $data = $request->input();
    
      User::create([
        'name' => $data['codigo_encargado_facultad'],
        'email'=> $data['correo_encargado_facultad'],
        'password' => bcrypt($contra)
      ])->assignRole('Encargado Facultad');
		
      $usuario = User::where('name', '=', $data['codigo_encargado_facultad'])->firstOrFail();
      $id = $usuario->id;
      
      $encargado = new EncargadoFacultad();
      $encargado->nombre_encargado_facultad = $data['nombre_encargado_facultad'];
      $encargado->apellido_encargado_facultad = $data['apellido_encargado_facultad'];
      $encargado->correo_encargado_facultad = $data['correo_encargado_facultad'];
      $encargado->codigo_encargado_facultad = $data['codigo_encargado_facultad'];
      $encargado->facultad_id = $data['facultad_id'];
      $encargado->estado_encargado_facultad = $data['estado_encargado_facultad'];
      $encargado->user_id = $id;
      $encargado->dui_encargado_facultad = $data['dui_encargado_facultad'];
      $encargado->telefono_encargado_facultad = $data['telefono_encargado_facultad'];
      $encargado->save();

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
        //$facultades = Facultad::all();
        /*$facultades = DB::table('facultades')
        ->leftJoin('encargado_facultades', 'facultades.id', '=', 'encargado_facultades.facultad_id')
        ->select('facultades.id AS idF', 'nombre_facultad')
        ->whereNull('encargado_facultades.id')
        ->orWhere('encargado_facultades.estado_encargado_facultad', '=', 'Inactivo')
        ->get();*/
        $facultades = DB::table('facultades')->distinct('nombre_facultad')
        ->select('facultades.id AS idF', 'nombre_facultad')
        ->whereNotIn('nombre_facultad', DB::table('encargado_facultades')
        ->select('nombre_facultad')
        ->distinct('nombre_facultad')
        ->join('facultades', 'encargado_facultades.facultad_id', '=', 'facultades.id')
        ->where('estado_encargado_facultad', '=', 'Activo'))
        ->get();
        $encargadoF = EncargadoFacultad::find($encargadoFacultad);
        $facultad = DB::table('facultades')->distinct('nombre_facultad')
        ->join('encargado_facultades', 'facultades.id', '=', 'encargado_facultades.facultad_id')
        ->select('facultades.id AS idF', 'nombre_facultad')
        ->where('encargado_facultades.id', '=', $encargadoFacultad)
        ->get();
        
        return Inertia::render('Components/FormEncargadoFacultad', ['encargadoF' => $encargadoF, 'facultades' => $facultades, 'facultad' => $facultad]);
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
            $encargado = EncargadoFacultad::where('facultad_id', '=', $encargadoF->facultad_id)
            ->where('estado_encargado_facultad', '=', 'Activo')
            ->get()->first();
            
            if ($encargado==null){
              $encargadoF->estado_encargado_facultad = "Activo";
              $encargadoF->save();
            } 
        }
             
        //$encargadoF->delete();
        return Redirect::route('encargadosfacultad.index');
    }
}
