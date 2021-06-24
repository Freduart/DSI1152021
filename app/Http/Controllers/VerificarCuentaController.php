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
        // $estudiantes=Estudiante::all();
        $estudiantes = Estudiante::where('estado_estudiante', '=', 'En espera')->get();
        return Inertia::render('Components/VerificarCuenta',['estudiantes'=>$estudiantes]);
    }

    /*public function update(Request $request, $id)
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
    }*/
       
    public function destroy($estudiante)
    {
        $estudiante=Estudiante::find($estudiante);
        if($estudiante->estado_estudiante == "En espera"){
            $estudiante->estado_estudiante = "Activo";
            $estudiante->save();
        }else{
            $estudiante->estado_estudiante="En espera";
            $estudiante->save();
        }
        return Redirect::route('verificarcuenta.index');
    }

    public function update($estudiante)
    {
        $estudiante=Estudiante::find($estudiante);
        if($estudiante->estado_estudiante == "En espera"){
            $estudiante->estado_estudiante = "Inactivo";
            $estudiante->save();
        }else{
            $estudiante->estado_estudiante="En espera";
            $estudiante->save();
        }
        return Redirect::route('verificarcuenta.index');
    }
}
