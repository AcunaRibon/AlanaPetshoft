<?php

namespace App\Http\Controllers;

use App\Models\Domiciliario;
use Illuminate\Http\Request;

class DomiciliarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domiciliarios = Domiciliario::all();
        $total = Domiciliario::count();
        return view('crud.venta.domiciliario.index', compact('domiciliarios', 'total'));

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
    public function store(Request $request)
    {
        $datosDomiciliario = request()->except('_token');
        Domiciliario::insert($datosDomiciliario);
        return redirect()->route('domiciliario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function show(Domiciliario $domiciliario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function edit($documento_domiciliario)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $documento_domiciliario)
    {
        $datosDomiciliario = request()->except('_token','_method');
        Domiciliario::where('documento_domiciliario','=',$documento_domiciliario)->update($datosDomiciliario);
        return redirect()->route('domiciliario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function destroy($documento_domiciliario)
    {
        Domiciliario::destroy($documento_domiciliario);
        return redirect()->route('domiciliario.index');
    }
}
