<?php

namespace App\Exports;

use App\Models\Proveedor;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProveedorExport implements FromView
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

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('crud.compra.proveedor.informe', [
            'proveedor' => Proveedor::select('proveedor.*')
            ->whereBetween('proveedor.created_at', [$this->fecha_inicio, $this->fecha_fin])
            ->orderBy($this->columna, $this->orden)
            ->get()
        ]);
    }
}