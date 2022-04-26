<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleCompra>
 */
class DetalleCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cantidad_detalle_compra' => $this->faker->numberBetween(1,80),
            'precio_detalle_compra' => $this->faker->numberBetween(20000, 4000000),
            'compra_id' => $this->faker->numberBetween(1, 40),
            'producto_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}
