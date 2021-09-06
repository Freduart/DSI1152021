<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ActividadesController extends Controller
{
    //
    public function index()
    {
        $actividades= Actividad::all();
        return Inertia::render("Components/Actividades/Actividades",['actividades' => $actividades]);
    }

    public function store(Request $request)
    {
        Actividad::create($request->all());
        return Redirect::route('actividades.index');
    }

    public function update(Request $request, $id)
    {
        $actividades=Actividad::find($id);
        $actividades->update($request->all());
        return Redirect::route('actividades.index');
    }

    public function destroy($id)
    {
        $actividades=Actividad::find($id);
        $actividades->delete();
        return Redirect::route('actividades.index');
    }
}
