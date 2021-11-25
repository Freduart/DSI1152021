<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;

use App\Models\Estudiante;
use App\Models\EncargadoEscuela;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function index(){
        $alumnosBySexo = null;
        if(Auth::check()){
            if(Auth::user()->hasRole('Encargado Escuela')){
                $idUsuario = Auth::id();
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->firstOrFail();
                $carrera = Carrera::where('id', '=', $encargado->carrera_id)->firstOrFail();
                // dd($carrera);
                // $estudiantes = Estudiante::where('carrera_id', '=', $carrera)->count();
                $alumnosBySexo = DB::select(DB::raw("select count(sexo_estudiante) as cant from estudiantes where carrera_id = :carreraid group by sexo_estudiante"),
                                         array('carreraid' => $carrera->id));
                // dd($alumnosBySexo);
                $alumnosByEstado = DB::select(DB::raw("select count(estado_estudiante) as estado from estudiantes where carrera_id = :carreraid group by estado_estudiante"),
                                         array('carreraid' => $carrera->id));
                     
                // dd($alumnosByEstado);                        
            }else{

            } 
        }else{

        }

        $estudiantes = Estudiante::all();

        return Inertia::render('Components/Estadisticas/Estadisticas', ['estudiantesBySexo' => $alumnosBySexo, 'carrera' => $carrera, 'estudiantesByEstado' => $alumnosByEstado]);
    }
}
