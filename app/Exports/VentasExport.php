<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VentasExport implements FromView
{

    protected $fecha_inicio;
    protected $fecha_fin;
    protected $columna;
    protected $orden;

    function __construct($fecha_inicio, $fecha_fin, $columna, $orden) 
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->columna = $columna;
        $this->orden = $orden;
    }
    
        public function view(): View
        {
            return view('crud.venta.gestionVenta.postExcel', [
                'ventas' => DB::table('venta')
                ->join('cliente', 'cliente.id_cliente', '=', 'venta.cliente_id')
                ->join('domiciliario', 'domiciliario.documento_domiciliario', '=', 'venta.domiciliario_documento')
                ->join('estado_venta', 'estado_venta.id_estado_venta', '=', 'venta.estado_venta_id')
                ->select('venta.*', 'cliente.nombres_cliente', 'cliente.id_cliente', 'cliente.apellidos_cliente', 'domiciliario.nombres_domiciliario', 'domiciliario.documento_domiciliario', 'domiciliario.apellidos_domiciliario', 'estado_venta.nombre_estado_venta')
                ->where('estado_venta.nombre_estado_venta', '!=', 'Cancelada')
                ->whereBetween("venta.fecha_venta", [$this->fecha_inicio, $this->fecha_fin])
                ->orderBy($this->columna, $this->orden)
                ->get(),

                'detalles' => DB::table('detalle_venta')
                ->join('producto', 'producto.id_producto', '=', 'detalle_venta.producto_id')
                ->select('detalle_venta.*', 'producto.nombre_producto', 'producto.precio_producto', 'producto.precio_producto')
                ->get()
            ]);
        }
    
}
