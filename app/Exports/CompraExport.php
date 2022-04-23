<?php

namespace App\Exports;

use App\Models\Compra;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CompraExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('crud.compra.gestionCompra.informe', [
            'compra' => Compra::select("compra.*", "proveedor.nombre_proveedor", "detalle_compra.*", "producto.nombre_producto")
            ->join("proveedor", "compra.proveedor_id", "=", "proveedor.id_proveedor")
            ->join("detalle_compra", "compra.id_compra", "=", "detalle_compra.compra_id")
            ->join("producto", "detalle_compra.producto_id", "=", "producto.id_producto")
            ->where("compra.estado_pedido_compra", "!=", "Cancelado")
            ->get()
        ]);
    }
}