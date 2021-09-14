<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\ProyectoSocial;
use App\Models\TipoServicioSocial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = ProyectoSocial::join('peticiones','proyectos_sociales.peticion_id', '=', 'peticiones.id')
                    ->join('carreras', 'peticiones.carrera_id', '=', 'carreras.id')
                    ->join('facultades', 'carreras.facultad_id', '=', 'facultades.id')
                    ->join('tipos_servicio_social', 'peticiones.tipo_servicio_social_id', '=', 'tipos_servicio_social.id')
                    ->join('instituciones', 'peticiones.institucion_id', '=','instituciones.id')
                    ->get();
        $tipos = TipoServicioSocial::select('nombre_tipo_servicio')->get();
        $carreras = Carrera::select('nombre_carrera')->get();            
        return Inertia::render('Components/ServicioSocial/ListarServicioSocial', ['servicios' => $servicios, 'tipos' => $tipos, 'carreras' => $carreras]);            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProyectoSocial  $proyectoSocial
     * @return \Illuminate\Http\Response
     */
    public function show(ProyectoSocial $proyectoSocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProyectoSocial  $proyectoSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(ProyectoSocial $proyectoSocial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProyectoSocial  $proyectoSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProyectoSocial $proyectoSocial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProyectoSocial  $proyectoSocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProyectoSocial $proyectoSocial)
    {
        //
    }
}
