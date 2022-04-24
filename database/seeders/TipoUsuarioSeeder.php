<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuario')->insert([
            'nombre_tipo_usuario' => 'Administrador'
        ]);

        DB::table('tipo_usuario')->insert([
            'nombre_tipo_usuario' => 'Empleado'
        ]);

        DB::table('tipo_usuario')->insert([
            'nombre_tipo_usuario' => 'Cliente'
        ]);
    }
}
