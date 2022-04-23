<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductoExport implements FromView
{
    public function view(): View
    {
        return view('crud.producto.gestionProducto.postExcel', [
           'productos' => DB::table('producto')
        ->where("estado_producto", "=",1)
            ->join('tipo_producto', 'producto.tipo_producto_id', '=', 'tipo_producto.id_tipo_producto')
            ->select('producto.*',  'tipo_producto.nombre_tipo_producto', 'tipo_producto.id_tipo_producto')
            ->get(),
        
            'calificaciones' => DB::table('calificacion_producto')
                ->select('producto_id', 'valor_calificacion_producto',DB::raw('COUNT(*) as total_Calificaciones'))
                ->groupBy('valor_calificacion_producto')
                ->groupBy('producto_id')
                ->havingRaw('COUNT(*) > 1')
                ->get()
        ]);
    }
}
