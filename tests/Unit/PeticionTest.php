<?php

namespace Tests\Unit;

// use App\Models\Institucion;

use App\Models\Carrera;
use App\Models\Institucion;
use App\Models\Peticion;
use App\Models\ProyectoSocial;
use App\Models\TipoServicioSocial;
use Illuminate\Database\Eloquent\Collection;
// use App\Models\Peticion;
use Tests\TestCase;

class PeticionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $peticion = new Peticion();
        $institucion = new Institucion();
        $proyectoS = new ProyectoSocial();
        $carrera = new Carrera();
        $tipoServicio = new TipoServicioSocial();
        
        $peticion->instituciones = $institucion;
        $peticion->proyectosSociales = $proyectoS;
        $peticion->carreras = $carrera;
        $peticion->tiposServicioSocial = $tipoServicio;

        $this->assertInstanceOf(Institucion::class, $peticion->instituciones);
        $this->assertInstanceOf(ProyectoSocial::class, $peticion->proyectosSociales);
        $this->assertInstanceOf(Carrera::class, $peticion->carreras);
        $this->assertInstanceOf(TipoServicioSocial::class, $peticion->tiposServicioSocial);
    }
}
