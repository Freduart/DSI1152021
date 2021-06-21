<?php

namespace App\Http\Controllers;
use App\Models\Estudiante;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VerificarCuentaController extends Controller
{
    //
    public function index(){
        $estudiantes=Estudiante::all();
        return Inertia::render('Components/VerificarCuenta',['estudiantes'=>$estudiantes]);
    }

    public function update(Request $request, $id)
    {
        $estadoCliente=$request->estado_estudiante;

        $estudiante=Estudiante::find($id);
        $estadoServidor=$estudiante->estado_estudiante;

        if($estadoCliente ==$estadoServidor){
            $estudiante->update($request->all());
        }
        else{
            $estudiante->estado_estudiante=$estadoCliente;
            $estudiante->save();
        }
        return Redirect::route('verificarcuenta.index');


    }
}
