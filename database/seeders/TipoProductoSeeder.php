<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_producto')->insert([
            'nombre_tipo_producto' => 'Alimentos'
        ]);

        DB::table('tipo_producto')->insert([
            'nombre_tipo_producto' => 'Juguetes'
        ]);

        DB::table('tipo_producto')->insert([
            'nombre_tipo_producto' => 'Accesorios'
        ]);

        DB::table('tipo_producto')->insert([
            'nombre_tipo_producto' => 'Medicamentos'
        ]);
    }
}
