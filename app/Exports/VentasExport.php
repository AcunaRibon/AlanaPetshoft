<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VentasExport implements FromView
{

    
        public function view(): View
        {
            return view('crud.venta.gestionVenta.postExcel', [
                'ventas' => DB::table('venta')
                ->join('cliente', 'cliente.id_cliente', '=', 'venta.cliente_id')
                ->join('domiciliario', 'domiciliario.documento_domiciliario', '=', 'venta.domiciliario_documento')
                ->join('estado_venta', 'estado_venta.id_estado_venta', '=', 'venta.estado_venta_id')
                ->select('venta.*', 'cliente.nombres_cliente', 'cliente.id_cliente', 'cliente.apellidos_cliente', 'domiciliario.nombres_domiciliario', 'domiciliario.documento_domiciliario', 'domiciliario.apellidos_domiciliario', 'estado_venta.nombre_estado_venta')
                ->where('estado_venta.nombre_estado_venta', '!=', 'Cancelada')
                ->get(),

                'detalles' => DB::table('detalle_venta')
                ->join('producto', 'producto.id_producto', '=', 'detalle_venta.producto_id')
                ->select('detalle_venta.*', 'producto.nombre_producto', 'producto.precio_producto', 'producto.precio_producto')
                ->get()
            ]);
        }
    
}
