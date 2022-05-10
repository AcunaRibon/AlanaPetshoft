<?php

namespace App\Http\Controllers;

use App\Models\MiDomicilio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\EstadoVenta;

class MiDomicilioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  


        
        $authUser = Auth::user()->id;

        $estadosVentas = DB::table('estado_venta')
        ->select('*')
        ->get();

        $Activados = DB::table('venta')
        ->select(DB::raw('count(id_venta) as Contador'),'estado_venta_id')
        ->groupBy('estado_venta_id')
        ->get();
        



        $datos['detalleDomicilio'] = DB::table('detalle_venta')
            ->join('producto' , 'detalle_venta.producto_id','=', 'producto.id_producto' )
            ->join('venta' , 'detalle_venta.venta_id','=', 'venta.id_venta' )
            ->select('venta.id_venta' ,'detalle_venta.*', 'producto.nombre_producto', 'producto.precio_producto')
            ->get();

        $misDomicilios = DB::table('venta')
        ->select('venta.id_venta','venta.fecha_venta','venta.descuento_venta','venta.total_venta', 'domiciliario.nombres_domiciliario')
        ->join('domiciliario','venta.domiciliario_documento' , '=' ,'domiciliario.documento_domiciliario')
        ->where('venta.cliente_id', '=', $authUser)
        ->get();

        return view('crud.venta.miDomicilio.index',compact('misDomicilios','estadosVentas','Activados'), $datos);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MiDomicilio  $miDomicilio
     * @return \Illuminate\Http\Response
     */
    public function show(MiDomicilio $miDomicilio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MiDomicilio  $miDomicilio
     * @return \Illuminate\Http\Response
     */
    public function edit(MiDomicilio $miDomicilio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MiDomicilio  $miDomicilio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MiDomicilio $miDomicilio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MiDomicilio  $miDomicilio
     * @return \Illuminate\Http\Response
     */
    public function destroy(MiDomicilio $miDomicilio)
    
    {
        //
    }
}
