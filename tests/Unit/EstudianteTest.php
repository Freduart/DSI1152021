<?php

namespace Tests\Feature;

use App\Models\Bitacora;
use App\Models\Carrera;
use App\Models\ConstanciaCumplimiento;
use App\Models\Estudiante;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EstudianteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $estudiante = new Estudiante();

        $carrera = new Carrera();
        $estudiante->carrera = $carrera;
        $this->assertInstanceOf(Carrera::class, $estudiante->carrera);

        $constanciaCumplimiento = new ConstanciaCumplimiento();
        $estudiante->constanciaCumplimiento = $constanciaCumplimiento;
        $this->assertInstanceOf(ConstanciaCumplimiento::class, $estudiante->constanciaCumplimiento);

        $this->assertInstanceOf(Collection::class, $estudiante->bitacora);

        $solicitud = new Solicitud();
        $estudiante->solicitud = $solicitud;
        $this->assertInstanceOf(Solicitud::class, $estudiante->solicitud);

        $usuario = new User();
        $estudiante->usuario = $usuario;
        $this->assertInstanceOf(User::class, $estudiante->usuario);
    }
}
