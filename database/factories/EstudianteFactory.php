<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstudianteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estudiante::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_estudiante' => $this->faker->name(),
            'apellido_estudiante' => $this->faker->name(),
            'carnet_estudiante' => Str::random(7),
            'sexo_estudiante' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'correo_estudiante' => Str::random(10).'@gmail.com',
            'telefono_estudiante' => Str::random(9),
            'carrera_id' => $this->faker->numberBetween(1, 12),
            'dui_estudiante' => Str::random(10),
            'nit_estudiante' => Str::random(17),
            'materias_cursadas' => $this->faker->numberBetween(31, 50),
            'porcentaje_aprobacion'=>$this->faker->numberBetween(60, 90),
            'cantidad_horas_ss' => '0',
            'estado_estudiante' => $this->faker->randomElement(['Inactivo', 'En espera', 'Realizando servicio', 'Servicio finalizado']),
        ];
    }
}
