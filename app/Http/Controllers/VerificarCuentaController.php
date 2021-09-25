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

  
       
    public function destroy($estudiante)
    {
 
      $estudiant=Estudiante::find($estudiante);
      $estudiant->delete();
      return Redirect::route('verificarcuenta.index');
    }

    public function update(Request $request, $estudiante)
    {
 
        $estudiant=Estudiante::find($estudiante);
        $estudiant->estado_estudiante = "Activo";

 
        $contra = "adminadmin";

        $data = $request->input();
        
 
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
}
