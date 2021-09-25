<?php

namespace App\Http\Controllers;
use App\Models\Estudiante;
use App\Models\Carrera;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\EncargadoEscuela;

class VerificarCuentaController extends Controller
{
    //
    public function index(){

        // validando que el usuario ha iniciado sesion
        if(Auth::check()){            
            // validando el rol del usuario logeado
            if (Auth::user()->hasRole('Encargado Escuela')) {
                // obteniendo el id del usuario logeado
                $idUsuario = Auth::id();

                // obteniendo el encargado logeado
                $encargado = EncargadoEscuela::where('user_id', '=', $idUsuario)->firstOrFail();

                $estudiantes = Estudiante::where('estado_estudiante', '=', 'En espera')->where('carrera_id', '=', $encargado->carrera_id)->get();
                return Inertia::render('Components/VerificarCuenta',['estudiantes'=>$estudiantes]);
            }
        }

        
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
        /*$estudiante=Estudiante::find($estudiante);
        if($estudiante->estado_estudiante == "En espera"){
            $estudiante->estado_estudiante = "Activo";
            $estudiante->save();
        }else{
            $estudiante->estado_estudiante="En espera";
            $estudiante->save();
        }
        return Redirect::route('verificarcuenta.index');*/
        //return $estudiante;
      $estudiant=Estudiante::find($estudiante);
      $estudiant->delete();
      return Redirect::route('verificarcuenta.index');
    }

    public function update(Request $request, $estudiante)
    {
        /*$estudiante=Estudiante::find($estudiante);
        if($estudiante->estado_estudiante == "En espera"){
            $estudiante->estado_estudiante = "Inactivo";
            $estudiante->save();
        }else{
            $estudiante->estado_estudiante="En espera";
            $estudiante->save();
        }
        return Redirect::route('verificarcuenta.index');*/
        $estudiant=Estudiante::find($estudiante);
        $estudiant->estado_estudiante = "Activo";

        /*$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $contra = substr(str_shuffle($permitted_chars), 0, 10);*/
        $contra = "adminadmin";

        $data = $request->input();
        
        /*$user = new User();
        $user->name = $data['carnet_estudiante'];
        $user->email = $data['correo_estudiante'];
        $user->password = Hash::make($contra);    
        $user->save();*/

        User::create([
          'name' => $data['carnet_estudiante'],
          'email'=> $data['correo_estudiante'],
          'password' => bcrypt($contra)
        ])->assignRole('Estudiante');

        //envio de correo
        
      
        $usuario = User::where('email', '=', $data['correo_estudiante'])->firstOrFail();
        $id = $usuario->id;
      
        $estudiant->user_id = $id;
        $estudiant->save();

        return Redirect::route('verificarcuenta.index');
    }

    /*public function eliminar($id)
    {
      $estudiante=Estudiante::find($id);
      $estudiante->delete();
        return Redirect::route('verificarcuenta.index');
    }*/
}
