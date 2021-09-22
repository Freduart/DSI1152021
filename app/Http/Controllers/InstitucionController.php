<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Environment\Console;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Traemos las instituciones
        $institucion = Institucion::all();
        return Inertia::render('Components/Instituciones/instituciones', ['instituciones' => $institucion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Inicializamos de datos la institucion
        $institucion = new Institucion();
        $institucion -> id = null;
        $institucion -> user_id = null;
        $institucion -> nombre_institucion = 'h';
        $institucion -> contacto_institucion = 'h';
        $institucion -> correo_institucion = 'h';
        $institucion -> telefono_institucion = 'h';
        $institucion -> ubicacion_institucion = 'h';
        $institucion -> rubro_institucion = 'h';         
        return Inertia::render('Components/Instituciones/FormInstitucion', ['instituciones', $institucion]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
			/* 
        // Se le asigna la contraseña
        $contra = "institucion";
        // Se obtienen los datos del request
        $data = $request -> input();

        // Creando la institucion
        $institucion = new Institucion();
        $institucion->nombre_institucion = $data['nombre_institucion'];
        $institucion->contacto_institucion = $data['contacto_institucion'];
        $institucion->correo_institucion = $data['correo_institucion'];
        $institucion->telefono_institucion = $data['telefono_institucion'];
        $institucion->ubicacion_institucion = $data['ubicacion_institucion'];
        $institucion->rubro_institucion = $data['rubro_institucion'];

        if($institucion->save()){
					// Creando la institucion y asignandole el rol
					User::create([
							'name' => $data['nombre_institucion'],
							'email' => $data['correo_institucion'],
							'password' => bcrypt($contra)
					])->assingRole('Institucion');

					$usuario= User::where('name', '=', $data['nombre_institucion'])->firstOrFail();
					error_log($usuario);
					
					$id=$usuario->id;

					// Asignamos el usuario a la institucion
					$institucion = Institucion::where('nombre_institucion', '=', $data['correo_institucion'])->firstOrFail();
					error_log($institucion);
        }

        Institucion::create($request->all());
        return Redirect::route('instituciones.index'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show(Institucion $institucion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function edit($institucion)
    {
        //Obteniendo los datos de las instituciones
        $institucion = Institucion::find($institucion);
        return Inertia('Components/Instituciones/FormInstitucion', ['instituciones' => $institucion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $institucion)
    {
        // Necesitamos encontrar a la institucion para poder actualizarlo
        $institucion = Institucion::find($institucion);
        $institucion -> update($request -> all());
        return Redirect::route('instituciones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Elimina la institucion a partir del id de la institucion
        $institucion = Institucion::find($id);
        $institucion -> delete();
        return Redirect::route('instituciones.index');
    }
}
