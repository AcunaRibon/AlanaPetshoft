<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;


class MiDomicilioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $authUser = Cliente::where('correo_electronico_cliente', '=', Auth::user()->email)->first();

            $datos['estados'] = DB::table('venta')
                ->select('estado_venta.nombre_estado_venta', DB::raw('COUNT(venta.id_venta) as total_estados'))
                ->join('estado_venta', 'venta.estado_venta_id', '=', 'estado_venta.id_estado_venta')
                ->where('venta.cliente_id', '=', $authUser->id_cliente)
                ->groupBy('estado_venta.nombre_estado_venta')
                ->get();




            $datos['detalleDomicilio'] = DB::table('detalle_venta')
                ->join('producto', 'detalle_venta.producto_id', '=', 'producto.id_producto')
                ->join('venta', 'detalle_venta.venta_id', '=', 'venta.id_venta')
                ->select('venta.id_venta', 'detalle_venta.*', 'producto.nombre_producto', 'producto.precio_producto')
                ->get();

                $datos['misDomicilios'] = DB::table('venta')
                ->select('venta.id_venta', 'venta.fecha_venta', 'venta.descuento_venta', 'venta.total_venta', 'domiciliario.nombres_domiciliario')
                ->join('domiciliario', 'venta.domiciliario_documento', '=', 'domiciliario.documento_domiciliario')
                ->where('venta.cliente_id', '=', $authUser->id_cliente)
                ->get();

            return view('crud.venta.miDomicilio.index',  $datos)->with('status', 'listado');
        } catch (\Exception $e) {
            return redirect('/miDomicilio')->with('status', $e->getMessage());
        }
    
    }

}
