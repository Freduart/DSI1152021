<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BitacoraController extends Controller
{
    //Metodo para visualizar todos los campos de las actividades
    public function index()
    {
        $bitacoras = Bitacora::all();
        $actividades= Actividad::all();
        return Inertia::render("Components/Actividades/FormBitacora",['actividades' => $actividades]);
    }
}
