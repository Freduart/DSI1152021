<?php

namespace Tests\Unit;

use App\Models\EncargadoFacultad;
use App\Models\Facultad as ModelsFacultad;
use App\Models\User;
// use Facultad;
use PHPUnit\Framework\TestCase;

class EncargadoFacultadTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $EncargadoFacultad = new EncargadoFacultad();
        $facultad = new ModelsFacultad();
        $usuario = new User();

        $EncargadoFacultad->facultad = $facultad;
        $EncargadoFacultad->usuario = $usuario;

        $this->assertInstanceOf(ModelsFacultad::class, $EncargadoFacultad->facultad);
        $this->assertInstanceOf(User::class, $EncargadoFacultad->usuario);
    }
}
