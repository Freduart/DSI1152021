<?php

namespace Tests\Feature;

use App\Models\Carrera;
use App\Models\EncargadoEscuela;
use App\Models\Estudiante;
use App\Models\Facultad;
use App\Models\Peticion;
use App\Models\TipoServicioSocial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarreraTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $carrera = new Carrera();
        $facultad = new Facultad();
        $estudiante = new Estudiante();
        $encargadoEscuela = new EncargadoEscuela();

        $carrera->estudiante = $estudiante;
        $carrera->encargadoEscuela = $encargadoEscuela;
        $carrera->facultad = $facultad;

        $this->assertInstanceOf(Collection::class, $carrera->peticiones);
        $this->assertInstanceOf(Estudiante::class, $carrera->estudiante);
        $this->assertInstanceOf(EncargadoEscuela::class, $carrera->encargadoEscuela);
        $this->assertInstanceOf(Facultad::class, $carrera->facultad);
        $this->assertInstanceOf(Collection::class, $carrera->tiposServicioSocial);
    }
}
