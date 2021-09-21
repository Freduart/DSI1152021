<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ActividadesController extends Controller
{
    //Metodo para ver en la tabla principal todos los campos necesarios de la tabla actividad
    public function index()
    {
        //$actividades= Actividad::all();
        $actividades = Actividad::where('verificado','=','En espera')->get();
        return Inertia::render("Components/Actividades/Actividades",['actividades' => $actividades]);
    }
     
    //Metodo para crear todas las actividades que el estudiante necesita
    public function store(Request $request)
    {
        Actividad::create($request->all());
        return Redirect::route('actividades.index');
    }

    
     //Metodo para actualizar todos los campos necesarios de la tabla de actividades
    public function update(Request $request, $id)
    {
        $actividades=Actividad::find($id);
        $actividades->update($request->all());
        return Redirect::route('actividades.index');
    }


     //Metodo para borrar todas las actividades
    public function destroy($id)
    {
        $actividades=Actividad::find($id);
        $actividades->delete();
        return Redirect::route('actividades.index');
    }
}
