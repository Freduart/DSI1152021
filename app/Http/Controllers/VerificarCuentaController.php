<?php

namespace App\Http\Controllers;
use App\Models\Estudiante;
use App\Models\Carrera;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VerificarCuentaController extends Controller
{
    //
    public function index(){
        return Inertia::render('Components/VerificarCuenta');
    }
}
