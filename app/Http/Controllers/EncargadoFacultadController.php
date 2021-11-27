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
use App\Mail\CredencialesMailable;
use Illuminate\Support\Facades\Mail;

class EncargadoFacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // obteniendo las facultades
        $facultades = Facultad::all();
        // obteniendo los encarcargados de las facultades
        $encargadoFacultad = EncargadoFacultad::join('facultades', 'encargado_facultades.facultad_id', '=', 'facultades.id')
        ->select('encargado_facultades.id AS idEncargado', 'codigo_encargado_facultad', 'dui_encargado_facultad', 'nombre_encargado_facultad', 'apellido_encargado_facultad', 'correo_encargado_facultad', 'telefono_encargado_facultad', 'estado_encargado_facultad', 'nombre_facultad', 'facultad_id')->get();
        return Inertia::render('Components/EncargadoFacultad/ListarEncargadoFacultad', ['encargadosF' => $encargadoFacultad, 'facultades' => $facultades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // inicializacion de datos del encargado de escuela
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
      
      // obteniendo las facultades que aun no tienen asignado encargado de facultad activo
      $facultades = DB::table('facultades')->distinct('nombre_facultad')
        ->select('facultades.id AS idF', 'nombre_facultad')
        ->whereNotIn('nombre_facultad', DB::table('encargado_facultades')
        ->select('nombre_facultad')
        ->distinct('nombre_facultad')
        ->join('facultades', 'encargado_facultades.facultad_id', '=', 'facultades.id')
        ->where('estado_encargado_facultad', '=', 'Activo'))
        ->get();

      return Inertia::render('Components/EncargadoFacultad/FormEncargadoFacultad', ['encargadoF' => $encargadoF,'facultades' => $facultades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      $request->validate([
        'correo_encargado_facultad' => 'required|unique:encargado_facultades|regex:/^.+@.+$/i',
        'codigo_encargado_facultad' => 'required|unique:encargado_facultades|max:12',
        'dui_encargado_facultad' => 'required|unique:encargado_facultades|regex:/[0-9]{8}-[0-9]/i|size:10',
        'telefono_encargado_facultad' => 'required|unique:encargado_facultades|regex:/[0-9]{4}(-)?[0-9]{4}/i',
      ]);
      // generación de contraseña
      /*$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
      $contra = substr(str_shuffle($permitted_chars), 0, 10);*/
      $contra = "adminadmin";

      // obteniendo la data de request
      $data = $request->input();
    
      // creando el encargado
      $encargado = new EncargadoFacultad();
      $encargado->nombre_encargado_facultad = $data['nombre_encargado_facultad'];
      $encargado->apellido_encargado_facultad = $data['apellido_encargado_facultad'];
      $encargado->correo_encargado_facultad = $data['correo_encargado_facultad'];
      $encargado->codigo_encargado_facultad = $data['codigo_encargado_facultad'];
      $encargado->facultad_id = $data['facultad_id'];
      $encargado->estado_encargado_facultad = $data['estado_encargado_facultad'];
      $encargado->dui_encargado_facultad = $data['dui_encargado_facultad'];
      $encargado->telefono_encargado_facultad = $data['telefono_encargado_facultad'];

      if($encargado->save()){

        // creando el usuario y asignando el rol
        User::create([
          'name' => $data['codigo_encargado_facultad'],
          'email'=> $data['correo_encargado_facultad'],
          'password' => bcrypt($contra),
          'rol'=>'Encargado Facultad'
        ])->assignRole('Encargado Facultad');
        
        // obteniendo el id usuario creado
        $usuario = User::where('name', '=', $data['codigo_encargado_facultad'])->firstOrFail();
        $id = $usuario->id;

        // asignando el usuario al encargado
        $encargado = EncargadoFacultad::where('correo_encargado_facultad', '=', $data['correo_encargado_facultad'])->firstOrFail();
        $encargado->user_id = $id;
        $encargado->save();

        //envio de correo
        //details es un array que contiene las variables que se van a renderizar en la vista del correo
        $details = [
          'usuario' => $data['correo_encargado_facultad'],
          'contraseña' => $contra,
          'mensaje' => 'Estimado/a '.$data['nombre_encargado_facultad'].' '.$data['apellido_encargado_facultad'].', su cuenta como encargado de facultad en SASS-UES ha sido creada.',
        ];
        //Se crea un objeto correo de tipo CredencialesMailable para el envio de correo de credenciales
        //Se debe crear otra clase de tipo Mailable si se quiere crear un correo que sirva para otra cosa
        $correo = new CredencialesMailable($details);
        //Se envía el correo, con la dirección del estudiante
        Mail::to($data['correo_encargado_facultad'])->send($correo);  
      }

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
        // obteniendo las facultades que aun no tienen asignado encargado de facultad activo
        $facultades = DB::table('facultades')->distinct('nombre_facultad')
        ->select('facultades.id AS idF', 'nombre_facultad')
        ->whereNotIn('nombre_facultad', DB::table('encargado_facultades')
        ->select('nombre_facultad')
        ->distinct('nombre_facultad')
        ->join('facultades', 'encargado_facultades.facultad_id', '=', 'facultades.id')
        ->where('estado_encargado_facultad', '=', 'Activo'))
        ->get();
        // obteniendo datos del encargado de facultad
        $encargadoF = EncargadoFacultad::find($encargadoFacultad);
        // obteniendo la facultad del encargado de facultad
        $facultad = DB::table('facultades')->distinct('nombre_facultad')
        ->join('encargado_facultades', 'facultades.id', '=', 'encargado_facultades.facultad_id')
        ->select('facultades.id AS idF', 'nombre_facultad')
        ->where('encargado_facultades.id', '=', $encargadoFacultad)
        ->get();
        
        return Inertia::render('Components/EncargadoFacultad/FormEncargadoFacultad', ['encargadoF' => $encargadoF, 'facultades' => $facultades, 'facultad' => $facultad]);
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
        // actualizando datos
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
        // cambio de estado del encargado de escuela
        $encargadoF = EncargadoFacultad::find($encargadoFacultad);
        if ($encargadoF->estado_encargado_facultad == "Activo"){
            $encargadoF->estado_encargado_facultad = "Inactivo";
            $encargadoF->save();
        } else {
            // validando si existe un encargado activo antes de activar otro
            $encargado = EncargadoFacultad::where('facultad_id', '=', $encargadoF->facultad_id)
            ->where('estado_encargado_facultad', '=', 'Activo')
            ->get()->first();
            
            if ($encargado==null){
              // cambiando estado a activo en caso de no haber otro activo
              $encargadoF->estado_encargado_facultad = "Activo";
              $encargadoF->save();
            } 
        }
        
        return Redirect::route('encargadosfacultad.index');
    }
}
