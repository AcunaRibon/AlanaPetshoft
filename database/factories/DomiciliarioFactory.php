<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domiciliario>
 */
class DomiciliarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'documento_domiciliario' => $this->faker->unique(true)->numberBetween(1000000000, 9999999999),
            'nombres_domiciliario' => $this->faker->name(),
            'apellidos_domiciliario' => $this->faker->lastName(),
            'celular_domiciliario' => $this->faker->unique(true)->numberBetween(1000000000, 9999999999),
            'estado_domiciliario' => $this->faker->boolean()
        ];
    }
}
