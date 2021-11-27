<?php

namespace Tests\Unit;

use App\Models\Carrera;
use App\Models\EncargadoEscuela;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class EncargadoEscuelaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $encargadoEscuela = new EncargadoEscuela();
        $carrera = new Carrera();
        $usuario = new User();

        $encargadoEscuela->carrera = $carrera;
        $encargadoEscuela->usuario = $usuario;

        $this->assertInstanceOf(Carrera::class, $encargadoEscuela->carrera);
        $this->assertInstanceOf(User::class, $encargadoEscuela->usuario);        
    }
}
