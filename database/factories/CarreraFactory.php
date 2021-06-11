<?php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'nombre_carrera' => $this->faker->name(),
            'codigo_carrera' => "COD-CAR",
            'facultad_id' => $this->faker->numberBetween(1, 9)    
        ];
    }
}
