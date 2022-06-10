<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_venta')->insert([
            'nombre_estado_venta' => 'Entregada'
        ]);

        DB::table('estado_venta')->insert([
            'nombre_estado_venta' => 'Cancelada'
        ]);

        DB::table('estado_venta')->insert([
            'nombre_estado_venta' => 'Pedido'
        ]);
    }
}
