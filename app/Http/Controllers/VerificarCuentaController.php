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
use App\Mail\CredencialesMailable;
use Illuminate\Support\Facades\Mail;
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

 
        $contra = "estudiante";

        $data = $request->input();
        
        User::create([
          'name' => $data['carnet_estudiante'],
          'email'=> $data['correo_estudiante'],
          'password' => bcrypt($contra)
        ])->assignRole('Estudiante');



        //envio de correo
        //details es un array que contiene las variables que se van a renderizar en la vista del correo
        $details = [
            'usuario' => $estudiant->correo_estudiante,
            'contraseña' => $contra,
            'mensaje' => 'Su solicitud de registro en el sistema SASS-UES ha sido aceptada',
        ];
        //Se crea un objeto correo de tipo CredencialesMailable para el envio de correo de credenciales
        //Se debe crear otra clase de tipo Mailable si se quiere crear un correo que sirva para otra cosa
        $correo = new CredencialesMailable($details);
        //Se envía el correo, con la dirección del estudiante
        Mail::to($estudiant->correo_estudiante)
              ->send($correo);       
      


        $usuario = User::where('email', '=', $data['correo_estudiante'])->firstOrFail();
        $id = $usuario->id;
      
        $estudiant->user_id = $id;
        $estudiant->save();

        return Redirect::route('verificarcuenta.index');
    }
}
