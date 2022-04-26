<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\DetalleCompra;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidarRegistrarCompra;
use App\Http\Requests\ValidarModificarCompra;
use App\Exports\CompraExport;
use Maatwebsite\Excel\Facades\Excel;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = Producto::all();
        $proveedor = Proveedor::all();

        $compra = Compra::select("compra.*", "proveedor.nombre_proveedor")
            ->join("proveedor", "compra.proveedor_id", "=", "proveedor.id_proveedor")
            ->where("compra.estado_pedido_compra", "!=", "Cancelado")
            ->get();

        $compraCancelada = Compra::select("compra.*", "proveedor.nombre_proveedor")
            ->join("proveedor", "compra.proveedor_id", "=", "proveedor.id_proveedor")
            ->where("compra.estado_pedido_compra", "like", "Cancelado")
            ->get(); 
        
        $detalleCompra = DetalleCompra::select("detalle_compra.*", "producto.nombre_producto", "producto.precio_producto")
            ->join("compra", "compra.id_compra", "=", "detalle_compra.compra_id")
            ->join("producto", "producto.id_producto", "=", "detalle_compra.producto_id")
            ->get();

        $totalCompra = Compra::select("compra.*", "proveedor.nombre_proveedor")
            ->join("proveedor", "compra.proveedor_id", "=", "proveedor.id_proveedor")
            ->where("compra.estado_pedido_compra", "!=", "Cancelado")
            ->count();

        $totalCompraCancelada = Compra::select("compra.*", "proveedor.nombre_proveedor")
            ->join("proveedor", "compra.proveedor_id", "=", "proveedor.id_proveedor")
            ->where("compra.estado_pedido_compra", "like", "Cancelado")
            ->count(); 

        return view('crud.compra.gestionCompra.index', compact('producto', 'compra', 'proveedor', 'detalleCompra', 'totalCompra', 'compraCancelada', 'totalCompraCancelada'));
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
    public function store(ValidarRegistrarCompra $request)
    {
        $input = $request->all();

        try 
        {
            DB::beginTransaction();

            $compra = Compra::create([
                "total_compra"=>$input["total_compra"],
                "fecha_pedido_compra"=>$input["fecha_pedido_compra"],
                "fecha_entrega_compra"=>$input["fecha_entrega_compra"],
                "estado_pedido_compra"=>$input["estado_pedido_compra"],
                "proveedor_id"=>$input["proveedor_id"]
            ]);

            foreach($input["producto_id"] as $posicion => $valor)
            {
                DetalleCompra::create([
                    "cantidad_detalle_compra"=>$input["cantidad_detalle_compra"][$posicion],
                    "precio_detalle_compra"=>$input["precio_detalle_compra"][$posicion],
                    "compra_id"=>$compra->id_compra,
                    "producto_id"=>$valor
                ]);

                $cantidadVieja = DB::table('producto')
                    ->select('existencia_producto')
                    ->where('id_producto', '=', $valor)
                    ->value('existencia_producto');

                $cantidadNueva = DB::table('detalle_compra')
                    ->select('cantidad_detalle_compra')
                    ->where('producto_id', '=', $valor)
                    ->orderBy('id_detalle_compra', 'desc')
                    ->value('cantidad_detalle_compra');

                Producto::where('id_producto', $valor)
                    ->update([
                        "existencia_producto" => $cantidadVieja + $cantidadNueva,
                        "estado_producto" => 1
                    ]);
            }

            DB::commit();

            return redirect('/compra')->with('status', 'registrado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/compra')->with('status', $e->getMessage());
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        /* 
        $compra = Compra::findOrFail($id);

        $proveedor = Proveedor::select("proveedor.*")->get();
        $producto = Producto::select("producto.*")->get();

        $detalleCompra = [];

        if ($id != null)
        {
            $detalleCompra = DetalleCompra::select("detalle_compra.*", "producto.nombre_producto", "producto.precio_producto")
            ->join("compra", "compra.id_compra", "=", "detalle_compra.compra_id")
            ->join("producto", "producto.id_producto", "=", "detalle_compra.producto_id")
            ->where("detalle_compra.compra_id", "=", $id)
            ->get();
        }
        
        return view('crud.compra.gestionCompra.editar', compact('compra', 'detalleCompra', 'proveedor', 'producto'));
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarModificarCompra $request, $id)
    {
        $input = $request->all();

        try
        {
            DB::beginTransaction();

            foreach($input["id_detalle_compra"] as $detalle => $valor)
            {
                $detalleCompra = DetalleCompra::findOrFail($valor);

                if($input["llave_eliminar"][$detalle] == "true")
                {
                    if($detalleCompra->cantidad_detalle_compra > $input["cantidad_detalle_compra"][$detalle])
                    {
                        $cantidadInput = DB::table('detalle_compra')
                            ->select('cantidad_detalle_compra')
                            ->where('id_detalle_compra', '=', $detalleCompra->id_detalle_compra)
                            ->value('cantidad_detalle_compra');

                        $detalleCompra->cantidad_detalle_compra	= $input["cantidad_detalle_compra"][$detalle];
                        $detalleCompra->precio_detalle_compra = $input["precio_detalle_compra"][$detalle];
                        $detalleCompra->compra_id = $input["compra_id"][$detalle];
                        $detalleCompra->update();

                        $cantidadVieja = DB::table('producto')
                            ->select('existencia_producto')
                            ->where('id_producto', '=', $detalleCompra->producto_id)
                            ->value('existencia_producto');

                        $cantidadNueva = DB::table('detalle_compra')
                            ->select('cantidad_detalle_compra')
                            ->where('id_detalle_compra', '=', $detalleCompra->id_detalle_compra)
                            ->value('cantidad_detalle_compra');

                        Producto::where('id_producto', $detalleCompra->producto_id)
                            ->update([
                                "existencia_producto" => $cantidadVieja - ($cantidadInput - $cantidadNueva),
                                "estado_producto" => 1
                            ]);
                    }
                    elseif ($detalleCompra->cantidad_detalle_compra < $input["cantidad_detalle_compra"][$detalle])
                    {
                        $cantidadInput = DB::table('detalle_compra')
                            ->select('cantidad_detalle_compra')
                            ->where('id_detalle_compra', '=', $detalleCompra->id_detalle_compra)
                            ->value('cantidad_detalle_compra');

                        $detalleCompra->cantidad_detalle_compra	= $input["cantidad_detalle_compra"][$detalle];
                        $detalleCompra->precio_detalle_compra = $input["precio_detalle_compra"][$detalle];
                        $detalleCompra->compra_id = $input["compra_id"][$detalle];
                        $detalleCompra->update();

                        $cantidadVieja = DB::table('producto')
                            ->select('existencia_producto')
                            ->where('id_producto', '=', $detalleCompra->producto_id)
                            ->value('existencia_producto');

                        $cantidadNueva = DB::table('detalle_compra')
                            ->select('cantidad_detalle_compra')
                            ->where('id_detalle_compra', '=', $detalleCompra->id_detalle_compra)
                            ->value('cantidad_detalle_compra');

                        Producto::where('id_producto', $detalleCompra->producto_id)
                            ->update([
                                "existencia_producto" => $cantidadVieja + ($cantidadNueva - $cantidadInput),
                                "estado_producto" => 1
                            ]);
                    }
                }
                else
                {
                    $cantidadVieja = DB::table('producto')
                        ->select('existencia_producto')
                        ->where('id_producto', '=', $detalleCompra->producto_id)
                        ->value('existencia_producto');

                    $cantidadNueva = DB::table('detalle_compra')
                        ->select('cantidad_detalle_compra')
                        ->where('id_detalle_compra', '=', $detalleCompra->id_detalle_compra)
                        ->value('cantidad_detalle_compra');

                    if(($cantidadNueva - $cantidadVieja) == 0)
                        Producto::where('id_producto', $detalleCompra->producto_id)
                            ->update([
                                "existencia_producto" => $cantidadVieja - $cantidadNueva,
                                "estado_producto" => 0
                            ]);
                    else
                    {
                        Producto::where('id_producto', $detalleCompra->producto_id)
                            ->update([
                                "existencia_producto" => $cantidadVieja - $cantidadNueva,
                                "estado_producto" => 1
                            ]);
                    }

                    $detalleCompra->delete();
                }
            }

            $compra = Compra::findOrFail($id);

            if(isset($input["producto_id_".$id]))
            {
                foreach($input["producto_id_".$id] as $posicion => $producto)
                {
                    DetalleCompra::create([
                        "cantidad_detalle_compra"=>$input["cantidad_detalle_compra_".$id][$posicion],
                        "precio_detalle_compra"=>$input["precio_detalle_compra_".$id][$posicion],
                        "compra_id"=>$id,
                        "producto_id"=>$producto
                    ]);

                    $cantidadVieja = DB::table('producto')
                        ->select('existencia_producto')
                        ->where('id_producto', '=', $producto)
                        ->value('existencia_producto');

                    $cantidadNueva = DB::table('detalle_compra')
                        ->select('cantidad_detalle_compra')
                        ->where('producto_id', '=', $producto)
                        ->orderBy('id_detalle_compra', 'desc')
                        ->value('cantidad_detalle_compra');

                    Producto::where('id_producto', $producto)
                        ->update([
                            "existencia_producto" => $cantidadVieja + $cantidadNueva,
                            "estado_producto" => 1
                        ]);
                }
            }

            $compra->total_compra = $input["total_compra_m"];
            $compra->fecha_pedido_compra = $input["fecha_pedido_compra_m"];
            $compra->fecha_entrega_compra = $input["fecha_entrega_compra_m"];
            $compra->estado_pedido_compra = $input["estado_pedido_compra_m"];
            $compra->proveedor_id = $input["proveedor_id_".$id];

            $compra->update();

            DB::commit();

            return redirect('/compra')->with('status', 'actualizado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/compra')->with('status', $e->getMessage());
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
        $compra = Compra::findOrFail($id);

        try
        {
            DB::beginTransaction();

            if ($id != null)
            {
                $detalleCompra = DB::table('detalle_Compra')
                    ->where('compra_id', '=', $id)
                    ->get();

                foreach($detalleCompra as $detalle)
                {
                    $cantidadVieja = DB::table('producto')
                        ->select('existencia_producto')
                        ->where('id_producto', '=', $detalle->producto_id)
                        ->value('existencia_producto');

                    if($cantidadVieja != $detalle->cantidad_detalle_compra)
                    {
                        Producto::where('id_producto', $detalle->producto_id)
                        ->update([
                            "existencia_producto" => $cantidadVieja - $detalle->cantidad_detalle_compra,
                            "estado_producto" => 1
                        ]);
                    }
                    else
                    {
                        Producto::where('id_producto', $detalle->producto_id)
                        ->update([
                            "existencia_producto" => $cantidadVieja - $detalle->cantidad_detalle_compra,
                            "estado_producto" => 0
                        ]);
                    }
                }
            
                $compra->estado_pedido_compra = "Cancelado";
                $compra->update();
            }

            DB::commit();

            return redirect('/compra')->with('status', 'cancelado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/compra')->with('status', $e->getMessage());
        }
    }

    public function restore(Request $request, $id)
    {
        $request->all();

        try
        {
            DB::beginTransaction();

            $compra = Compra::findOrFail($id);

            $detalleCompra = DB::table('detalle_compra')
                ->select('detalle_compra.*')
                ->where('compra_id', '=', $id)
                ->get();

            foreach($detalleCompra as $detalle)
            {
                $cantidadVieja = DB::table('producto')
                    ->select('existencia_producto')
                    ->where('id_producto', '=', $detalle->producto_id)
                    ->value('existencia_producto');

                Producto::where('id_producto', $detalle->producto_id)
                    ->update([
                        "existencia_producto" => $cantidadVieja + $detalle->cantidad_detalle_compra,
                        "estado_producto" => 1  
                    ]);
            }

            $compra->estado_pedido_compra = $request["estado_pedido_compra_".$id];
            $compra->update();

            DB::commit();

            return redirect('/compra')->with('status', 'restaurado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/compra')->with('status', $e->getMessage());
        }
    }

    public function report()
    {
        return Excel::download(new CompraExport, 'compra.xlsx');
    }
}
