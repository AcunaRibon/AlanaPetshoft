<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Domiciliario;
use App\Models\Producto;
use App\Models\detalleVenta;
use App\Models\Cliente;
use App\Models\venta;
use App\Models\CalificacionProducto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Exception;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $datos['productos']= DB::table('producto')
        ->where('existencia_producto','>',0)
        ->where('estado_producto','!=',0)
        ->select('producto.*')
        ->get();
        $datos['imagenes']= array();
        foreach($datos['productos'] as $producto){
            array_push($datos['imagenes'],DB::table('imagen_producto')->select('producto_id','url_imagen_producto')->where('producto_id','=',$producto->id_producto)->first());
        }
      
        return view('shop.productos', $datos); 
    }


    public function detalle($id_producto)
    {
       
        
        $datos['producto']= DB::table('producto')
        ->where('id_producto','=',$id_producto)
        ->select('producto.*')
        ->get();
        $datos['imagenes']= DB::table('imagen_producto')->select('producto_id','url_imagen_producto')->get();
        

        

        return view('shop.detalle', $datos);

    
    }

    

    public function redirect()
    {
        $datos = Producto::paginate(3);
        $user = auth()->user();
        $count=Cart::where('phone', $user->phone)->count();

        return view('layouts.app', compact('datos', 'count'));
    }

    public function addcart(Request $request, $id)
    {
        $user=Auth::user()->id;
        $datoscart = DB::table('carts')
        ->join('producto', 'carts.id_producto', '=', 'producto.id_producto')
        ->where('carts.id_user', '=', $user)
        ->select('producto.*', 'carts.id as cart_id', 'carts.quantity')
        ->get();

        $validator = false;
        foreach($datoscart as $dato){ 
            if($dato->id_producto == $id){
                $validator=true;
            }
        }

        try{
            DB::beginTransaction();
        if(Auth::check())
        {
            if(!$validator){
               
               
                Cart::create([
                    "id_producto" => $id,
                    "id_user"=>$user,
                    "quantity"=>$request->quantity

                    ]);
                    DB::commit();
                return redirect("/productos")->with('status', 'registrado');
            }else{
               
             
                throw new Exception('Producto Agregado');
            }
           
            
            
        }
        else {
            return redirect('/login');
        }
       
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect("/productos")->with('status', $e->getMessage());
    }
}

    public function cartlist()
    {

        if(Auth::check())
        {
            if(Cart::where('id_user','=',Auth::user()->id)->first()!==null){

        $user=Auth::user()->id;
        $datos['cart'] = DB::table('carts')
        ->join('producto', 'carts.id_producto', '=', 'producto.id_producto')
        ->where('carts.id_user', '=', $user)
        ->select('producto.*', 'carts.id as cart_id', 'carts.quantity')
        ->get();

        $datos['imagenes']= array();
        foreach($datos['cart'] as $producto){
            array_push($datos['imagenes'],DB::table('imagen_producto')->select('producto_id','url_imagen_producto')->where('producto_id','=',$producto->id_producto)->first());
        }

        
        $datos['total'] = $this->calcular_precio($datos['cart']);

        return view('shop.cartlist', $datos)->with('status', 'listado');
            }else{
                return view('shop.cartout'); 
            }

        }
        else {
            return view('shop.cartout');
        }

    

    }

    public function enviorden(Request $request) {
        $input = $request->all();
        

        $Domiciliario =Domiciliario::where('estado_domiciliario','=',1)
        ->orderByRaw('rand()')
        ->take(1)
        ->get();

        $cliente = Cliente::where('correo_electronico_cliente', '=', Auth::user()->email)
        ->select('*')
        ->first();

        $user=Auth::user()->id;
        $cart = DB::table('carts')
            ->join('producto', 'carts.id_producto', '=', 'producto.id_producto')
            ->where('carts.id_user', '=', $user)
            ->select('producto.*', 'carts.id as cart_id', 'carts.quantity')
            ->get();

        try{
            DB::beginTransaction();
            $venta = venta::insertGetId([
                "fecha_venta" => date('Y-m-d'),
                "descuento_venta" => 0,
                "total_venta" => $this->calcular_precio($cart),
                "calificacion_servicio_venta" => null,
                "cliente_id" => $cliente->id_cliente,
                "domiciliario_documento" => $Domiciliario[0]->documento_domiciliario,
                "estado_venta_id" => 3
            ]);

            foreach ($cart as $key => $producto) {
                $P = Producto::find($producto->id_producto);
                detalleVenta::create([
                    "cantidad_detalle_venta" => $input["quantity"][$key],
                    "precio_detalle_venta" => ($P->precio_producto * $input["quantity"][$key]),
                    "venta_id" => $venta,
                    "producto_id" => $producto->id_producto

                    
                ]);
                if ($P->existencia_producto >= $input["quantity"][$key]){
                    $P->update(["existencia_producto" => $P->existencia_producto - $input["quantity"][$key]]);
                } else {
                    throw new Exception('Cantidad excedida');
                }

                Cart::where('id_user', $user)->delete();
            }
            DB::commit();
            return view('shop.thanks')->with('status', 'registrado');
        

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/cartlist")->with('status', $e->getMessage());
        }
        
      


        /*$datos = Cart::all;
        $datos->delete();

        DB::commit();
        return redirect()->back();*/
        
        
    }
    
    public function calcular_precio($productos)
    {
        $precio = 0;
        foreach ($productos as $producto) {
            $P = Producto::find($producto->id_producto);
            $precio += ($P->precio_producto * $producto->quantity);
        }

        return $precio;
    }

    

    public function search(Request $request)
    {
        if(Producto::where('nombre_producto', 'like', '%'.$request->input('query').'%')->first()!== null) {

        $datos = Producto::
        join('imagen_producto', 'producto.id_producto', '=', 'imagen_producto.producto_id')
        ->where('nombre_producto', 'like', '%'.$request->input('query').'%')
        ->get();

        return view('shop.search', ['productos'=>$datos]);
        }
        else {
            return view('shop.searchout');
        }
    }

    public function orderPlace(Request $request,$id){
        $input = $request->all();
        
        try{
            DB::beginTransaction();
            
            CalificacionProducto::create([ 
                "valor_calificacion_producto"=> $input['calificacion'],
                "producto_id"=>$id
                         ]);
              
            
            DB::commit();
            return redirect("/detalle/$id")->with('status', 'registrado');
        

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/detalle/$id")->with('status', $e->getMessage());
        }
    }

    
    public function deletecart($cart_id)
    {
        try
        
        {
                $datos = Cart::find($cart_id);
                $datos->delete();

                DB::commit();
                return redirect()->back()->with('status', '1');
            
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect("/cartlist")->with('status', $e->getMessage());
        }
    }
}

