<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tipoProducto;
use Illuminate\Queue\RedisQueue;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoProductos =TipoProducto::all();
        $total = tipoProducto::count();
        return view('crud.producto.tipoProducto.index', compact('tipoProductos', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dtsTiproducto = request()->except('_token');
        
      
        try {
            DB::beginTransaction();
         
            
            TipoProducto::insert($dtsTiproducto);
            DB::commit();
            return redirect("/tipoProducto")->with('status', '1');

                } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/tipoProducto")->with('status', $e->getMessage());
           
                }
      
    }

    
    public function update(Request $request, $id)
    {
        $dtsTiproducto = request()->except('_token','_method');
        
      
        try {
            DB::beginTransaction();
         
            
            TipoProducto::where('id_tipo_producto','=',$id)->update($dtsTiproducto);
            DB::commit();
            return redirect("/tipoProducto")->with('status', '1');

                } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/tipoProducto")->with('status', $e->getMessage());
           
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
        try {
            DB::beginTransaction();
         
            
            tipoProducto::destroy($id);
            DB::commit();
            return redirect("/tipoProducto")->with('status', '1');

                } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/tipoProducto")->with('status', $e->getMessage());
           
                }
    }
}
