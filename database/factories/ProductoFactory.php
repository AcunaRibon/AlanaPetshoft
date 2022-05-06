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
            'nombre_producto' => $this->faker->realTextBetween(5, 40),
            'existencia_producto' => $this->faker->numberBetween(0, 5000),
            'precio_producto' => $this->faker->numberBetween(15000, 800000),
            'estado_producto' => $this->faker->boolean(),
            'tipo_producto_id' =>$this->faker->randomElement(TipoProducto::select('tipo_producto.id_tipo_producto')->get())
        ];
    }
}
