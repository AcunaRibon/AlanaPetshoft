<?php

namespace App\Http\Controllers;

use App\Models\Domiciliario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomiciliarioController extends Controller
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
        $domiciliarios = Domiciliario::all();
        $total = Domiciliario::count();
        return view('crud.venta.domiciliario.index', compact('domiciliarios', 'total'))->with('status', 'listado');
        }
        catch(\Exception $e)
        {
            return redirect('/domiciliario')->with('status', $e->getMessage());
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
    public function store(Request $request)
    {
        try
        {
            $datosDomiciliario = request()->except('_token');
            Domiciliario::insert($datosDomiciliario);
            return redirect()->route('domiciliario.index')->with('status', 'registrado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/domiciliario')->with('status', $e->getMessage());
        }
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

        try
        {
            $datosDomiciliario = request()->except('_token','_method');
            Domiciliario::where('documento_domiciliario','=',$documento_domiciliario)->update($datosDomiciliario);
            
            return redirect()->route('domiciliario.index')->with('status', 'actualizado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/domiciliario')->with('status', $e->getMessage());
        }
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
