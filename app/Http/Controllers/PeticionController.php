<?php

namespace App\Http\Controllers;

use App\Models\Peticion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PeticionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index()
    {
        return Peticion::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //Este metodo guarda la peticion
        $peticion= new Peticion;
        $peticion->create($request->all());        
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Peticion $peticion
     * @return \Illuminate\Http\Response
     */
    public function show(Peticion $peticion)
    {                
        return $peticion;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peticion $peticion)
    {
        //Para actualizar el registro
        $peticion->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peticion $peticion)
    {
        //Para borrar el registro
        $peticion->delete();
    }
}
