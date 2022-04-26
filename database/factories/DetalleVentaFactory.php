<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleVenta>
 */
class DetalleVentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cantidad_detalle_venta' => $this->faker->numberBetween(1, 30),
            'precio_detalle_venta' => $this->faker->numberBetween(20000, 400000),
            'venta_id' => $this->faker->numberBetween(1, 40),
            'producto_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}
