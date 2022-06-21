<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\MiDomicilioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileadminController;
use App\Http\Controllers\Auth\LoginController;



use App\Mail\MailOrderDetailMailable;
use Illuminate\Support\Facades\Mail;



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

Route::group(['middleware' => 'auth.admin'], function () {

    Route::resource('usuario', UserController::class);
    Route::get('/admin/report/', [UserController::class, 'report'])->name('usuario.report');
    Route::get('/proveedor/report', [ProveedorController::class, 'report'])->name('proveedor.report');
    Route::resource('proveedor', ProveedorController::class);
    Route::put('/compra/{id_compra}/restore', [CompraController::class, 'restore'])->name('compra.restore');
    Route::get('/compra/report', [CompraController::class, 'report'])->name('compra.report');
    Route::get('/producto/export_excel', [ProductoController::class, 'export'])->name('producto.export');
    Route::delete('/producto/{id_imagen_producto}/destroyImg', [ProductoController::class, 'destroyImg'])->name('producto.destroyImg');
    Route::resource('compra', CompraController::class);
    Route::resource('tipoProducto', TipoProductoController::class);
    Route::resource('producto', ProductoController::class);
    Route::resource('tipoUsuario', TipoUsuarioController::class);
    Route::resource('profileadmin', ProfileadminController::class);
    Route::put('/profileadmin/{id}/update', [ProfileadminController::class, 'update']);
    Route::get('/venta/export_excel', [VentaController::class, 'export'])->name('venta.export');
Route::resource('venta', VentaController::class);
Route::resource('estadoVenta', EstadoVentaController::class);
Route::resource('domiciliario', DomiciliarioController::class);
    
});



Route::group(['middleware' => 'auth.emp'], function () {

    Route::get('/venta/export_excel', [VentaController::class, 'export'])->name('venta.export');
    Route::resource('venta', VentaController::class);
    Route::resource('estadoVenta', EstadoVentaController::class);
     Route::resource('profileadmin', ProfileadminController::class);
    Route::put('/profileadmin/{id}/update', [ProfileadminController::class, 'update']);
    Route::resource('domiciliario', DomiciliarioController::class);
});


Route::group(['middleware' => 'auth.cliente'], function () {
    
    Route::resource('profile', ProfileController::class);
    Route::put('/profile/{id}/update', [ProfileController::class, 'update']);
    Route::resource('miDomicilio', MiDomicilioController::class);
    Route::get('/redirect', [ShopController::class, 'redirect']);
    Route::get('/productos', [ShopController::class, 'index'])->name('shop.index');
    Route::get('detalle/{id_producto}', [ShopController::class, 'detalle']);
    Route::get('/search', [ShopController::class, 'search']);
    Route::post('/addcart/{id_producto}', [ShopController::class, 'addcart'])->name('shop.addcart');
    Route::post('/orderPlace/{id_producto}', [ShopController::class, 'orderPlace'])->name('shop.order');
    Route::get('/cartlist', [ShopController::class, 'cartlist']);
    Route::get('/delete/{id}', [ShopController::class, 'deletecart']);
    Route::post('/envioOrden', [ShopController::class, 'enviorden'])->name('shop.export');
    
  
    Route::get('/home', function () {
        return view('index');
    });


    });

   
Route::group(['middleware' => 'auth'], function () {
Route::resource('profileadmin', ProfileadminController::class);
Route::put('/profileadmin/{id}/update', [ProfileadminController::class, 'update']);
Route::get('/venta/export_excel', [VentaController::class, 'export'])->name('venta.export');
Route::resource('venta', VentaController::class);
Route::resource('estadoVenta', EstadoVentaController::class);
Route::resource('domiciliario', DomiciliarioController::class);
Route::get('/home', function () {
    return view('index');
});

});


