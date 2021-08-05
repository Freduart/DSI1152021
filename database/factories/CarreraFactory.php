<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarreraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carrera::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_carrera' => Str::random(10),
            'codigo_carrera' => Str::random(7),
            'materias_para_aprobar'=>$this->faker->numberBetween(32, 40),
            'facultad_id' => $this->faker->numberBetween(1, 9)    
        ];
    }
}
