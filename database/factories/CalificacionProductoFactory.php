<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalificacionProducto>
 */
class CalificacionProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'valor_calificacion_producto' => $this->faker->numberBetween(1, 5),
            'producto_id' => $this->faker->randomElement(Producto::select('producto.id_producto')->get())
        ];
    }
}
