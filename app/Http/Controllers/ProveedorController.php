<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidarRegistrarProveedor;
use App\Http\Requests\ValidarModificarProveedor;
use App\Http\Requests\ValidarRegistrarCompra;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use App\Exports\ProveedorExport;
use App\Http\Requests\ValidarReporteProveedor;
use Maatwebsite\Excel\Facades\Excel;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $proveedor = Proveedor::all(); 
            $total = Proveedor::count();
            return view('crud.compra.proveedor.index', compact('proveedor', 'total'))->with('status', 'listado');
        }
        catch(\Exception $e)
        {
            return redirect('/proveedor')->with('status', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarRegistrarProveedor $request)
    {     
        try
        {
            DB::beginTransaction();
            Proveedor::create($request->all()); 
            DB::commit();
            return redirect('/proveedor')->with('status', 'registrado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/proveedor')->with('status', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarModificarProveedor $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        try
        {
            DB::beginTransaction();
            $proveedor->nombre_proveedor = $request->nombre_proveedor_m;
            $proveedor->celular_proveedor = $request->celular_proveedor_m;
            $proveedor->update();
            DB::commit();
            return redirect('/proveedor')->with('status', 'actualizado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/proveedor')->with('status', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* 
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedor.index');
        */
    }

    public function report(ValidarReporteProveedor $request)
    {
        return Excel::download(new ProveedorExport($request->fecha_inicio, $request->fecha_fin, $request->columna, $request->orden), 'proveedor.xlsx');
    }
}
