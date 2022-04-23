<?php

namespace App\Http\Controllers;

use App\Models\estadoVenta;
use Illuminate\Http\Request;

class EstadoVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estadoVenta=estadoVenta::paginate(5);
        $total = estadoVenta::count();
        return view('crud.venta.estadoVenta.index',compact('estadoVenta', 'total'));
    }

    
    public function store(Request $request)
    {
        $datosEstadoVenta = request()->except('_token');
        estadoVenta::insert($datosEstadoVenta);
        return redirect()->route('estadoVenta.index');
    }

   
    public function update(Request $request, $id_estado_venta)
    {
        $datosEstadoVenta = request()->except('_token','_method');
        estadoVenta::where('id_estado_venta','=',$id_estado_venta)->update($datosEstadoVenta);
        return redirect()->route('estadoVenta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estadoVenta  $estadoVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_estado_venta)
    {
        estadoVenta::destroy($id_estado_venta);
        return redirect()->route('estadoVenta.index');
    }
}

