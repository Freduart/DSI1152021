<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Carrera;
use App\Models\EncargadoEscuela;
use App\Models\EncargadoFacultad;
use App\Models\Estudiante;
use App\Models\Facultad;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
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
                $estudiantes = Facultad::join('carreras', 'carreras.facultad_id', '=', 'facultades.id')
                ->join('estudiantes', 'estudiantes.carrera_id', '=', 'carreras.id')
                ->select('*')->get();
            }else if(Auth::user()->hasRole('Encargado Escuela')){
                $idUsuario = Auth::id();
                $usuario = User::where('id', '=', $idUsuario)->firstOrFail();
                $encargadoEscuela = EncargadoEscuela::where('user_id', '=', $usuario->id)->firstOrFail();
                $estudiantes = Facultad::join('carreras', 'carreras.facultad_id', '=', 'facultades.id')
                ->join('estudiantes', 'estudiantes.carrera_id', '=','carreras.id')
                ->select('*')->where('estudiantes.carrera_id', '=', $encargadoEscuela->carrera_id)->get();                
            }else if(Auth::user()->hasRole('Encargado Facultad')){
                $idUsuario = Auth::id();
                $usuario = User::where('id', '=', $idUsuario)->firstOrFail();
                $encargadoFacultad = EncargadoFacultad::where('user_id', '=', $usuario->id)->firstOrFail();

                $estudiantes = DB::select(DB::raw("select * from estudiantes 
                join carreras on carreras.id = estudiantes.carrera_id
                join facultades on facultades.id = carreras.facultad_id 
                where carreras.facultad_id = :facultadid"),
                array('facultadid' => $encargadoFacultad->facultad_id));
            }else{
                return Redirect::route('dashboard');
            }
        }else{
            return Redirect::route('login');
        }
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

        // return $request->hasFile('archivo_comprobante');
        // return dd($request->file('archivo_comprobante'));
        // return $request->all();



        $request->validate([
            'carnet_estudiante' => 'required|unique:estudiantes|regex:/[a-zA-Z]{2}[0-9]{5}/i|size:7',
            'correo_estudiante' => 'required|unique:estudiantes|regex:/^.+@.+$/i',
            'dui_estudiante' => 'required|unique:estudiantes|regex:/[0-9]{8}-[0-9]/i|size:10',
            'nit_estudiante' => 'required|unique:estudiantes|regex:/[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]/i|size:17',
            'telefono_estudiante' => 'required|unique:estudiantes|regex:/[0-9]{4}(-)?[0-9]{4}/i',
        ]);

        $carrera = Carrera::find($request->carrera_id);
        
        Estudiante::create($request->all());
        // return $request->carnet_estudiante;
        $porcentaje = ($request->materias_cursadas/$carrera->materias_para_aprobar)*100;
        $estudiante = Estudiante::where('carnet_estudiante', '=', $request->carnet_estudiante)->firstOrFail();
        // return $request;
        // return $estudiante;
        // return $porcentaje;

        if($request->hasFile('archivo_comprobante_path')){
            $estudiante->subirArchivo($request->file('archivo_comprobante_path'));
        }

        $estudiante->porcentaje_aprobacion = $porcentaje;
        $estudiante->carnet_estudiante = strtoupper($estudiante->carnet_estudiante);
        $estudiante->save();
        // $url_archivo = $estudiante->archivo_comprobacion_url;
        // $estudiante->archivo_comprobante_url = str_replace('localhost', '127.0.0.1:8000', $url_archivo);
        // $estudiante->save();    
        // return Inertia::render('Admins/home');  
        return Redirect::route("homepage");  
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
        return Inertia::render('Components/FormEstudianteModificar');
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
