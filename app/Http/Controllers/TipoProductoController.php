<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\tipoProducto;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Validator;

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
        $this->validator($request->all())->validate();
      
        try {
            DB::beginTransaction();
         
            
            TipoProducto::create(["nombre_tipo_producto" => $dtsTiproducto['nombre_tipo_producto1']]);
            DB::commit();
            return redirect("/tipoProducto")->with('status', 'registrado');

                } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/tipoProducto")->with('status', $e->getMessage());
           
                }
      
    }

    
    public function update(Request $request, $id)
    {
        $dtsTiproducto = request()->except('_token','_method');
        
        $this->validatorUpdate($request->all())->validate();
        try {
            DB::beginTransaction();
         
            
            TipoProducto::where('id_tipo_producto','=',$id)->update(["nombre_tipo_producto" => $dtsTiproducto['nombre_tipo_producto2']]);
            DB::commit();
            return redirect("/tipoProducto")->with('status', 'actualizado');

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
            return redirect("/tipoProducto")->with('status', 'cancelado');

                } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/tipoProducto")->with('status', $e->getMessage());
           
                }
    }

    public function validator(array $input)
    {
        return Validator::make($input, [
            'nombre_tipo_producto1' => ['required','alpha', 'max:30','min:3'],
           
        ]);
    }
    public function validatorUpdate(array $input)
    {
        return Validator::make($input, [
            'nombre_tipo_producto2' => ['required','alpha', 'max:30','min:3'],
           
        ]);
    }
}
