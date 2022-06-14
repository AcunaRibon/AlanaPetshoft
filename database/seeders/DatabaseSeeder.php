<?php

namespace Database\Seeders;

use App\Models\CalificacionProducto;
use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;
use App\Models\Domiciliario;
use App\Models\ImagenProducto;
use App\Models\Producto;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoUsuarioSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EstadoVentaSeeder::class);
        $this->call(TipoProductoSeeder::class);
        User::factory(10)->create();
        Cliente::factory(10)->create();
        Domiciliario::factory(5)->create();
        Producto::factory(20)->create();
        ImagenProducto::factory(22)->create();
        CalificacionProducto::factory(20)->create();
        Proveedor::factory(8)->create();
    }
}
