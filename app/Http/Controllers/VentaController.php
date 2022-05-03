<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\venta;
use App\Models\detalleVenta;
use App\Models\Producto;
use App\Models\estadoVenta;
use App\Models\Domiciliario;
use App\Models\Cliente;
use App\Exports\VentasExport;
use Illuminate\Support\Facades\Validator;
use Exception;


class VentaController extends Controller
{

    public function export(Request $request) 
    {
        $this->validatorExport($request->all())->validate();
        try{
        return Excel::download(new VentasExport($request->fecha_inicio,$request->fecha_fin,$request->columna, $request->orden), 'ventas.xlsx');
        }catch(\Exception $e){
            return redirect("/venta")->with('status', $e->getMessage());
        }
        
    }
    
    public function index()
    {
        $datos['ventas'] = DB::table('venta')
            ->join('cliente', 'cliente.id_cliente', '=', 'venta.cliente_id')
            ->join('domiciliario', 'domiciliario.documento_domiciliario', '=', 'venta.domiciliario_documento')
            ->join('estado_venta', 'estado_venta.id_estado_venta', '=', 'venta.estado_venta_id')
            ->select('venta.*', 'cliente.nombres_cliente', 'cliente.id_cliente', 'cliente.apellidos_cliente', 'domiciliario.nombres_domiciliario', 'domiciliario.documento_domiciliario', 'domiciliario.apellidos_domiciliario', 'estado_venta.nombre_estado_venta')
            ->where('estado_venta.nombre_estado_venta', '!=', 'Cancelada')
            ->get();

        $datos['ventasCanceladas'] = DB::table('venta')
            ->join('cliente', 'cliente.id_cliente', '=', 'venta.cliente_id')
            ->join('domiciliario', 'domiciliario.documento_domiciliario', '=', 'venta.domiciliario_documento')
            ->join('estado_venta', 'estado_venta.id_estado_venta', '=', 'venta.estado_venta_id')
            ->select('venta.*', 'cliente.nombres_cliente', 'cliente.id_cliente', 'cliente.apellidos_cliente', 'domiciliario.nombres_domiciliario', 'domiciliario.documento_domiciliario', 'domiciliario.apellidos_domiciliario', 'estado_venta.nombre_estado_venta')
            ->where('estado_venta.nombre_estado_venta', '=', 'Cancelada')
            ->get();

        $datos['totalventa']=venta::all()->count();
        $Clientes = Cliente::all();
        $Productos = Producto::where('estado_producto',1)
        ->select('*')
        ->get();
        
        $Domiciliarios = Domiciliario::all();
        $estados = estadoVenta::all();
        $datos['detalles'] = DB::table('detalle_venta')
            ->join('producto', 'producto.id_producto', '=', 'detalle_venta.producto_id')
            ->select('detalle_venta.*', 'producto.nombre_producto', 'producto.precio_producto', 'producto.precio_producto')
            ->get();
        return view('crud.venta.gestionVenta.index', compact("Clientes", "Productos", "estados", "Domiciliarios"), $datos);
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        
        $input = $request->all();

        try {
            DB::beginTransaction();
            $venta = venta::insertGetId([
                "fecha_venta" => $input["fecha_venta1"],
                "descuento_venta" => $input["descuento_venta1"],
                "total_venta" => $this->calcular_precio($input["productos_id"], $input["cantidades"],$input["descuento_venta1"]),
                "calificacion_servicio_venta" => $input["calificacion_servicio_venta"],
                "cliente_id" => $input["cliente_id1"],
                "domiciliario_documento" => $input["domiciliario_documento1"],
                "estado_venta_id" => $input["estado_venta_id1"]
            ]);

            foreach ($input["productos_id"] as $key => $producto) {
                $P = Producto::find($producto);
                detalleVenta::create([
                    "cantidad_detalle_venta" => $input["cantidades"][$key],
                    "precio_detalle_venta" => ($P->precio_producto * $input["cantidades"][$key]),
                    "venta_id" => $venta,
                    "producto_id" => $producto
                ]);
                if ($P->existencia_producto > $input["cantidades"][$key]) {
                    $P->update(["existencia_producto" => $P->existencia_producto - $input["cantidades"][$key]]);
                } else {
                    throw new Exception('Cantidad excedida');
                }
            }

            DB::commit();
            return redirect("/venta")->with('status', 'registrado');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/venta")->with('status', $e->getMessage());
        }
    }

    
    public function update(Request $request, $id)
    {

        $this->validatorUpdate($request->all())->validate();
        $input = $request->all();


        try {
            DB::beginTransaction();
            venta::where('id_venta', '=', $id)->update([
                "fecha_venta" => $input["fecha_venta2"],
                "descuento_venta" => $input["descuento_venta2"],
                "total_venta" => $this->calcular_precio($input["productos_id"], $input["cantidades"],$input["descuento_venta2"]),
                "calificacion_servicio_venta" => $input["calificacion_servicio_venta"],
                "cliente_id" => $input["cliente_id2"],
                "domiciliario_documento" => $input["domiciliario_documento2"],
                "estado_venta_id" => $input["estado_venta_id2"]
            ]);

            foreach ($input["productos_id"] as $key => $producto) {
                $P = Producto::find($producto);


                $cantidad_detalle = DB::table('detalle_venta')
                    ->select('*')
                    ->where('venta_id', '=', $id)
                    ->where('producto_id', '=', $P->id_producto)
                    ->get();

                if (isset($cantidad_detalle[0])) {
                    if ($P->existencia_producto > $input["cantidades"][$key]) {

                        if ($input["cantidades"][$key] < $cantidad_detalle[0]->cantidad_detalle_venta) {
                            $P->update(["existencia_producto" => $P->existencia_producto + abs($cantidad_detalle[0]->cantidad_detalle_venta - $input["cantidades"][$key])]);
                        } else {
                            $P->update(["existencia_producto" => $P->existencia_producto - abs($cantidad_detalle[0]->cantidad_detalle_venta - $input["cantidades"][$key])]);
                        }
                    } else {
                        throw new Exception('Cantidad excedida');
                    }
                } else {
                    $P->update(["existencia_producto" => $P->existencia_producto - $input["cantidades"][$key]]);
                }




                detalleVenta::updateOrCreate(
                    [
                        "venta_id" => $id,
                        "producto_id" => $producto
                    ],
                    [
                        "cantidad_detalle_venta" => $input["cantidades"][$key],
                        "precio_detalle_venta" => ($P->precio_producto * $input["cantidades"][$key]),
                    ]

                );
            }



            $Ds = DB::table('detalle_venta')
                ->select('*')
                ->where('venta_id', '=', $id)
                ->get();


            foreach ($input["productos_id"] as $key => $producto) {
                foreach ($Ds as $key => $D) {

                    if ($D->producto_id == $producto) {
                        unset($Ds[$key]);
                    }
                }
            }

            foreach ($Ds as $D) {
                $P = Producto::find($D->producto_id);
                detalleVenta::where('id_detalle_venta', $D->id_detalle_venta)->delete();
                $P->update(["existencia_producto" => $P->existencia_producto + $D->cantidad_detalle_venta]);
            }


            DB::commit();
            return redirect("/venta")->with('status', 'actualizado');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/venta")->with('status', $e->getMessage());
        }
    }
    
    public function destroy($id)
    {


        try {
            DB::beginTransaction();
            $venta = venta::find($id);
            $estado = estadoVenta::find($venta->estado_venta_id);
            $cancelada = estadoVenta::select('id_estado_venta')
            ->where('nombre_estado_venta','Cancelada')
            ->first();
            
            $habilitada = estadoVenta::select('id_estado_venta')
            ->where('nombre_estado_venta','Entregada')
            ->first();

            if ($estado->nombre_estado_venta != 'Cancelada') {

                $Ds = DB::table('detalle_venta')
                    ->select('*')
                    ->where('venta_id', '=', $id)
                    ->get();


                foreach ($Ds as $D) {
                    $P = Producto::find($D->producto_id);
                    
                    $P->update(["existencia_producto" => $P->existencia_producto + $D->cantidad_detalle_venta]);
                }


                venta::where('id_venta', '=', $id)->update([
                    "estado_venta_id" => $cancelada->id_estado_venta
                ]);
                $statusValidator = "cancelado";
                
            }else{
                $Ds = DB::table('detalle_venta')
                    ->select('*')
                    ->where('venta_id', '=', $id)
                    ->get();


                foreach ($Ds as $D) {
                    $P = Producto::find($D->producto_id);
                   
                    $P->update(["existencia_producto" => $P->existencia_producto - $D->cantidad_detalle_venta]);
                }
                venta::where('id_venta', '=', $id)->update([
                    "estado_venta_id" => $habilitada->id_estado_venta
                ]);
                $statusValidator = "restaurado";
            }

            DB::commit();
            return redirect("/venta")->with('status', $statusValidator);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/venta")->with('status', $e->getMessage());
        }
    }

    public function calcular_precio($productos, $cantidad,$descuento)
    {
        $precio = 0;
        foreach ($productos as $key => $producto) {
            $P = Producto::find($producto);
            $precio += ($P->precio_producto * $cantidad[$key]);
        }

        $precio = $precio-($precio * ($descuento/100));

        return $precio;
    }
    //

    public function validator( array $input){
        return Validator::make($input, [
         'fecha_venta1' => ['required', 'date'],
        'descuento_venta1'=>['required', 'int','max:100','min:0'],
         'cliente_id1'=>['required'],
        'domiciliario_documento1'=>['required'],
        'estado_venta_id1'=>['required'],
      
    ]);
    }
    public function validatorUpdate( array $input){
        return Validator::make($input, [
         'fecha_venta2' => ['required', 'date'],
        'descuento_venta2'=>['required', 'int','max:100','min:0'],
         'cliente_id2'=>['required'],
        'domiciliario_documento2'=>['required'],
        'estado_venta_id2'=>['required'],
      
    ]);
    }

    
    
    public function validatorExport( array $input){
        return Validator::make($input, [
         
        'fecha_inicio' =>['required'],
        'fecha_fin' =>['required','after_or_equal:fecha_inicio']
    ]);
    }
    


}