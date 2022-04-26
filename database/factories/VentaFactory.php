<?php

namespace Database\Factories;

use App\Models\Domiciliario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha_venta' => $this->faker->date(),
            'descuento_venta' => $this->faker->numberBetween(0, 100),
            'total_venta' => $this->faker->numberBetween(20000, 4000000),
            'calificacion_servicio_venta' => $this->faker->numberBetween(1, 5),
            'cliente_id' => $this->faker->numberBetween(1, 20),
            'domiciliario_documento' => $this->faker->randomElement(Domiciliario::select('domiciliario.documento_domiciliario')->get()),
            'estado_venta_id' => $this->faker->randomElement(['1', '2'])
        ];
    }
}
