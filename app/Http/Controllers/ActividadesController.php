<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Redirect;
class ActividadesController extends Controller
{
    public function index()
    {
         //Se obtienen todos los campos de tabla actividad
        $actividades = Actividad::all();
     return Inertia::render("Components/Actividades/Actividades",['actividades' => $actividades]);

    }

    public function store(Request $request)
    {
        Actividad::create($request->all());
        return Redirect::route('actividades.index');
    }

    public function destroy($id)
    {
        $actividades=Actividad::find($id);
        $actividades->delete();
        return Redirect::route('actividades.index');
    }
    
}
