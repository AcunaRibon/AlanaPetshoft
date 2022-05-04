<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\DetalleVenta;
use App\Models\Domiciliario;
use App\Models\Producto;
use App\Models\TipoProducto;
use App\Models\User;
use App\Models\Venta;

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
        User::factory(20)->create();
        Cliente::factory(20)->create();
        Domiciliario::factory(10)->create();
        TipoProducto::factory(10)->create();
        Producto::factory(100)->create();
        Venta::factory(50)->create();
        DetalleVenta::factory(150)->create();
        Proveedor::factory(20)->create();
        Compra::factory(50)->create();
        DetalleCompra::factory(150)->create();
    }
}
