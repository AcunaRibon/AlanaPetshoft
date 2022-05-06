<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres_cliente' => $this->faker->firstName(),
            'apellidos_cliente' => $this->faker->lastName(),
            'correo_electronico_cliente' => $this->faker->unique()->safeEmail(),
            'celular_cliente' => $this->faker->unique(true)->numberBetween(1000000000, 9999999999),
            'direccion_cliente' => $this->faker->address(),
            'estado_cliente' => $this->faker->boolean(),
        ];
    }
}
