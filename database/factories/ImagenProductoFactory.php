<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImagenProducto>
 */
class ImagenProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url_imagen_producto' => $this->faker->randomElement(['uploads/0imufXw3Iy6axsdcfNrpsCYZAf6pLKAFxaBx4Uyr.png']),
            'producto_id' => $this->faker->randomElement(Producto::select('producto.id_producto')->get())
        ];
    }
}
