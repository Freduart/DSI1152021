<?php

namespace Tests\Unit;

use App\Models\Facultad as ModelsFacultad;
// use Facultad;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class FacultadTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $facultad = new ModelsFacultad();
        
        $this->assertInstanceOf(Collection::class, $facultad->carreras);       
        // echo($facultad);
    }
}
