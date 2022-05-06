<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Compra;
use App\Models\Producto;

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
            'compra_id' => $this->faker->randomElement(Compra::select('compra.id_compra')->get()),
            'producto_id' => $this->faker->randomElement(Producto::select('producto.id_producto')->get())
        ];
    }
}
