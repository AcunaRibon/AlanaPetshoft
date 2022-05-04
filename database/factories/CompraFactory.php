<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\compra>
 */
class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total_compra' => $this->faker->numberBetween(500000, 9999999),
            'fecha_pedido_compra' => $this->faker->date(),
            'fecha_entrega_compra' => $this->faker->date(),
            'estado_pedido_compra' => $this->faker->randomElement(['No entregado', 'Entregado', 'Cancelado']),
            'proveedor_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
