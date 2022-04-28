<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DomiciliarioController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\EstadoVentaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\ShopController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home');


Route::group(['middleware' => 'emp'], function () {
Route::get('/emp', [App\Http\Controllers\UserController::class, 'index']);
Route::resource('usuario',UserController::class);
Route::get('/usuario/report/', [UserController::class, 'report'])->name('usuario.report');
Route::get('/proveedor/report', [ProveedorController::class, 'report'])->name('proveedor.report');
Route::resource('proveedor', ProveedorController::class);
Route::put('/compra/{id_compra}/restore', [CompraController::class, 'restore'])->name('compra.restore');
Route::get('/compra/report', [CompraController::class, 'report'])->name('compra.report');
Route::get('/producto/export_excel', [ProductoController::class, 'export'])->name('producto.export');
Route::get('/venta/export_excel', [VentaController::class, 'export'])->name('venta.export');
Route::resource('compra', CompraController::class);
Route::resource('domiciliario', DomiciliarioController::class);
Route::resource('tipoProducto', TipoProductoController::class);
Route::resource('producto', ProductoController::class);
Route::resource('venta', VentaController::class);
Route::resource('estadoVenta', EstadoVentaController::class);
Route::resource('tipoUsuario', TipoUsuarioController::class);
});



Route::group(['middleware' => 'admin'], function () {

Route::get('/admin', [App\Http\Controllers\UserController::class, 'index']);
Route::resource('usuario',UserController::class);
Route::get('/admin/report/', [UserController::class, 'report'])->name('admin.report');
Route::get('/proveedor/report', [ProveedorController::class, 'report'])->name('proveedor.report');
Route::resource('proveedor', ProveedorController::class);
Route::put('/compra/{id_compra}/restore', [CompraController::class, 'restore'])->name('compra.restore');
Route::get('/compra/report', [CompraController::class, 'report'])->name('compra.report');
Route::get('/producto/export_excel', [ProductoController::class, 'export'])->name('producto.export');
Route::get('/venta/export_excel', [VentaController::class, 'export'])->name('venta.export');
Route::delete('/producto/{id_imagen_producto}/destroyImg',[ProductoController::class, 'destroyImg'])->name('producto.destroyImg');
Route::resource('compra', CompraController::class);
Route::resource('domiciliario', DomiciliarioController::class);
Route::resource('tipoProducto', TipoProductoController::class);
Route::resource('producto', ProductoController::class);
Route::resource('venta', VentaController::class);
Route::resource('estadoVenta', EstadoVentaController::class);
Route::resource('tipoUsuario', TipoUsuarioController::class);
});




Route::get('/redirect', [ShopController::class, 'redirect']);

Route::get('/productos', [ShopController::class,'index']);

Route::get('detalle/{id_producto}', [ShopController::class, 'detalle']);

Route::get('/search', [ShopController::class, 'search']);

Route::post('/addcart/{id_producto}', [ShopController::class, 'addcart']);

Route::get('/cartlist', [ShopController::class, 'cartlist']);

Route::get('/delete/{id}', [ShopController::class, 'deletecart']);

Route::get('/ordernow', [ShopController::class, 'ordernow']);