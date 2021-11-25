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
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\EncargadoFacultad;
use App\Mail\CredencialesMailable;
use Illuminate\Support\Facades\Mail;

class EncargadoEscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facultad = null;
        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Encargado Facultad')) {
                $idUsuario = Auth::id();
                $encargadoF = EncargadoFacultad::where('user_id', '=', $idUsuario)->first();

                // obteniendo los encargados de escuela
                $encargadosEscuela = DB::table('encargado_escuelas')
                ->join('carreras', 'encargado_escuelas.carrera_id', '=', 'carreras.id')
                ->join('facultades', 'carreras.facultad_id', '=', 'facultades.id')
                ->select('encargado_escuelas.id AS idEncargado', 'codigo_encargado_escuela', 'dui_encargado_escuela', 'nombre_encargado_escuela', 'apellido_encargado_escuela', 'correo_encargado_escuela', 'telefono_encargado_escuela', 'estado_encargado_escuela', 'nombre_facultad', 'facultad_id', 'nombre_carrera', 'carrera_id')
                ->where('facultad_id', '=', $encargadoF->facultad_id)
                ->get();
                // obteniendo los encargados de facultad 
                $facultades = DB::table('facultades')->distinct('nombre_facultad')
                ->join('carreras', 'facultades.id', '=', 'carreras.facultad_id')
                ->join('encargado_escuelas', 'carreras.id', '=', 'encargado_escuelas.carrera_id')
                ->leftJoin('encargado_facultades', 'facultades.id', '=', 'encargado_facultades.facultad_id')
                ->select('facultades.id as id','nombre_facultad', 'estado_encargado_escuela', 'nombre_encargado_facultad', 'apellido_encargado_facultad')
                ->where('facultades.id', '=', $encargadoF->facultad_id)
                ->get();
                // obteniendo las carreras
                $carreras = Carrera::all();

            } else {
                //$facultades = Facultad::all();
                // obteniendo los encargados de escuela
                $encargadosEscuela = DB::table('encargado_escuelas')
                ->join('carreras', 'encargado_escuelas.carrera_id', '=', 'carreras.id')
                ->join('facultades', 'carreras.facultad_id', '=', 'facultades.id')
                ->select('encargado_escuelas.id AS idEncargado', 'codigo_encargado_escuela', 'dui_encargado_escuela', 'nombre_encargado_escuela', 'apellido_encargado_escuela', 'correo_encargado_escuela', 'telefono_encargado_escuela', 'estado_encargado_escuela', 'nombre_facultad', 'facultad_id', 'nombre_carrera', 'carrera_id')
                ->get();
                // obteniendo los encargados de facultad 
                $facultades = DB::table('facultades')->distinct('nombre_facultad')
                ->join('carreras', 'facultades.id', '=', 'carreras.facultad_id')
                ->join('encargado_escuelas', 'carreras.id', '=', 'encargado_escuelas.carrera_id')
                ->leftJoin('encargado_facultades', 'facultades.id', '=', 'encargado_facultades.facultad_id')
                ->select('nombre_facultad', 'estado_encargado_escuela', 'nombre_encargado_facultad', 'apellido_encargado_facultad')
                ->get();
                // obteniendo las carreras
                $carreras = Carrera::all();
            }
        }


        
        return Inertia::render('Components/EncargadoEscuela/ListarEncargadoEscuela', ['encargadosE' => $encargadosEscuela, 'facultades' => $facultades, 'carreras' => $carreras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // inicializacion de datos del encargado de escuela
        $encargadoE = new EncargadoEscuela();
        $encargadoE->id = null;
        $encargadoE->codigo_encargado_escuela = '';
        $encargadoE->nombre_encargado_escuela = '';
        $encargadoE->apellido_encargado_escuela = '';
        $encargadoE->correo_encargado_escuela = '';
        $encargadoE->carrera_id = '';
        $encargadoE->estado_encargado_escuela = 'Activo';
        $encargadoE->dui_encargado_escuela = '';
        $encargadoE->telefono_encargado_escuela = '';

        $facultades = null;
        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Encargado Facultad')) {
                $idUsuario = Auth::id();
                $encargadoF = EncargadoFacultad::where('user_id', '=', $idUsuario)->firstOrFail();
                $facultades = DB::table('facultades')->where('id','=',$encargadoF->facultad_id)->get();
                //$facultades = Facultad::find($encargadoF->facultad_id)->get();
            } else {
                $facultades = Facultad::all();
            }
        }

        // obteniendo las carreras que aun no tienen asignado encargado de escuela activo
        $carreras = DB::table('carreras')->distinct('nombre_carrera')
        ->select('carreras.id AS idC', 'nombre_carrera', 'facultad_id')
        ->whereNotIn('nombre_carrera', DB::table('encargado_escuelas')
        ->select('nombre_carrera')
        ->distinct('nombre_carrera')
        ->join('carreras', 'encargado_escuelas.carrera_id', '=', 'carreras.id')
        ->where('estado_encargado_escuela', '=', 'Activo'))
        ->get();
        return Inertia::render('Components/EncargadoEscuela/FormEncargadoEscuela', ['encargadoE' => $encargadoE,'facultades' => $facultades, 'carreras' => $carreras]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // generación de contraseña
        /*$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $contra = substr(str_shuffle($permitted_chars), 0, 10);*/
        $contra = "adminadmin";

        // obteniendo la data de request
        $data = $request->input(); 
        
        // creando el encargado
        $encargado = new EncargadoEscuela();
        $encargado->nombre_encargado_escuela = $data['nombre_encargado_escuela'];
        $encargado->apellido_encargado_escuela = $data['apellido_encargado_escuela'];
        $encargado->correo_encargado_escuela = $data['correo_encargado_escuela'];
        $encargado->codigo_encargado_escuela = $data['codigo_encargado_escuela'];
        $encargado->carrera_id = $data['carrera_id'];
        $encargado->estado_encargado_escuela = $data['estado_encargado_escuela'];
        $encargado->dui_encargado_escuela = $data['dui_encargado_escuela'];
        $encargado->telefono_encargado_escuela = $data['telefono_encargado_escuela'];
        
        if($encargado->save()){
            // creando el usuario y asignando el rol
            User::create([
                'name' => $data['codigo_encargado_escuela'],
                'email'=> $data['correo_encargado_escuela'],
                'password' => bcrypt($contra)
            ])->assignRole('Encargado Escuela');
                
            // obteniendo el id usuario creado
            $usuario = User::where('name', '=', $data['codigo_encargado_escuela'])->firstOrFail();
            $id = $usuario->id;
            
            // asignando el usuario al encargado
            $encargado = EncargadoEscuela::where('correo_encargado_escuela', '=', $data['correo_encargado_escuela'])->firstOrFail();
            $encargado->user_id = $id;
            $encargado->save();

            //envio de correo
            //details es un array que contiene las variables que se van a renderizar en la vista del correo
            $details = [
                'usuario' => $data['correo_encargado_escuela'],
                'contraseña' => $contra,
                'mensaje' => 'Estimado/a '.$data['nombre_encargado_escuela'].' '.$data['apellido_encargado_escuela'].', su cuenta como encargado de escuela en SASS-UES ha sido creada.',
            ];
            //Se crea un objeto correo de tipo CredencialesMailable para el envio de correo de credenciales
            //Se debe crear otra clase de tipo Mailable si se quiere crear un correo que sirva para otra cosa
            $correo = new CredencialesMailable($details);
            //Se envía el correo, con la dirección del estudiante
            Mail::to($data['correo_encargado_escuela'])->send($correo); 
        }

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
        // obteniendo las facultades
        $facultades = null;
        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado

            // obteniendo las carreras que aun no tienen asignado encargado de escuela activo
            $carreras = DB::table('carreras')->distinct('nombre_carrera')
            ->select('carreras.id AS idC', 'nombre_carrera', 'facultad_id')
            ->whereNotIn('nombre_carrera', DB::table('encargado_escuelas')
            ->select('nombre_carrera')
            ->distinct('nombre_carrera')
            ->join('carreras', 'encargado_escuelas.carrera_id', '=', 'carreras.id')
            ->where('estado_encargado_escuela', '=', 'Activo'))
            ->get();

            if (Auth::user()->hasRole('Encargado Facultad')) {
                $idUsuario = Auth::id();
                $encargadoF = EncargadoFacultad::where('user_id', '=', $idUsuario)->firstOrFail();
                
                $encargadoE = EncargadoEscuela::find($encargadoEscuela);
                $escuela = Carrera::find($encargadoE->carrera_id);
                $facultad = Facultad::find($escuela->facultad_id);

                if ($encargadoF->facultad_id == $facultad->id){
                    
                    $facultades = DB::table('facultades')->where('id','=',$encargadoF->facultad_id)->get();

                    // obtenindo el encargado
                    $encargadoE = EncargadoEscuela::find($encargadoEscuela);
                    // obteniendo el id de la facultad del encargado de escuela
                    $idCarrera = $encargadoE->carrera_id;
                    $carreraEncargado = Carrera::find($idCarrera);
                    $idFacultad = $carreraEncargado->facultad_id;
                    
                    // obteniendo la carrera del encargado de escuela
                    $escuela = DB::table('carreras')->distinct('nombre_carrera')
                    ->join('encargado_escuelas', 'carreras.id', '=', 'encargado_escuelas.carrera_id')
                    ->select('carreras.id AS idC', 'nombre_carrera', 'facultad_id')
                    ->where('encargado_escuelas.id', '=', $encargadoEscuela)
                    ->get();
                    return Inertia::render('Components/EncargadoEscuela/FormEncargadoEscuela', ['encargadoE' => $encargadoE, 'facultades' => $facultades, 'carreras' => $carreras, 'idFacultad' => $idFacultad, 'escuela'=> $escuela]);
    
                } else {
                    return Redirect::route('encargadosescuela.index'); 
                }
                
            } else {
                $facultades = Facultad::all();
                // obtenindo el encargado
                $encargadoE = EncargadoEscuela::find($encargadoEscuela);
                // obteniendo el id de la facultad del encargado de escuela
                $idCarrera = $encargadoE->carrera_id;
                $carreraEncargado = Carrera::find($idCarrera);
                $idFacultad = $carreraEncargado->facultad_id;
                
                // obteniendo la carrera del encargado de escuela
                $escuela = DB::table('carreras')->distinct('nombre_carrera')
                ->join('encargado_escuelas', 'carreras.id', '=', 'encargado_escuelas.carrera_id')
                ->select('carreras.id AS idC', 'nombre_carrera', 'facultad_id')
                ->where('encargado_escuelas.id', '=', $encargadoEscuela)
                ->get();
                return Inertia::render('Components/EncargadoEscuela/FormEncargadoEscuela', ['encargadoE' => $encargadoE, 'facultades' => $facultades, 'carreras' => $carreras, 'idFacultad' => $idFacultad, 'escuela'=> $escuela]);
    
            }
        }

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
        // actualizando datos
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
        // obteniendo las facultades
        $facultades = null;
        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Encargado Facultad')) {
                $idUsuario = Auth::id();
                $encargadoF = EncargadoFacultad::where('user_id', '=', $idUsuario)->firstOrFail();

                $encargadoE = EncargadoEscuela::find($encargadoEscuela);
                $escuela = Carrera::find($encargadoE->carrera_id);
                $facultad = Facultad::find($escuela->facultad_id);
                
                if ($encargadoF->facultad_id == $facultad->id){
                    // cambio de estado del encargado de escuela
                    $encargadoE = EncargadoEscuela::find($encargadoEscuela);
                    if ($encargadoE->estado_encargado_escuela == "Activo"){
                        $encargadoE->estado_encargado_escuela = "Inactivo";
                        $encargadoE->save();
                    } else {
                        $encargadoE->estado_encargado_escuela = "Activo";
                        $encargadoE->save();
                    }
                } else {
                    return Redirect::route('encargadosescuela.index'); 
                }
            } 
        }
        
        return Redirect::route('encargadosescuela.index');
    }
}
