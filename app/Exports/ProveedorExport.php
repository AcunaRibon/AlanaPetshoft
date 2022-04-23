<?php

namespace App\Exports;

use App\Models\Proveedor;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProveedorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('crud.compra.proveedor.informe', [
            'proveedor' => Proveedor::all()
        ]);
    }
}