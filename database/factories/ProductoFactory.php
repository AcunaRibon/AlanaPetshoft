<?php

namespace Database\Factories;

use App\Models\TipoProducto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_producto' => $this->faker->sentence(2),
            'existencia_producto' => $this->faker->numberBetween(0, 300),
            'precio_producto' => $this->faker->randomElement([15000, 27000, 34000, 43000, 55000, 68000, 78000, 85000, 92000, 100000]),
            'estado_producto' => $this->faker->boolean(),
            'tipo_producto_id' =>$this->faker->randomElement(TipoProducto::select('tipo_producto.id_tipo_producto')->get())
        ];
    }
}
