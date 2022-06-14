<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailOrderDetailMailable;
use App\Models\Cart;
use App\Models\Domiciliario;
use App\Models\Producto;
use App\Models\detalleVenta;
use App\Models\Cliente;
use App\Models\venta;
use App\Models\User;
use App\Models\CalificacionProducto;
use App\Models\ImagenProducto;
use App\Models\TipoProducto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Session;
use Producto as GlobalProducto;

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
        ->join('imagen_producto', 'producto.id_producto', '=', 'imagen_producto.producto_id')
        ->select('producto.*', 'imagen_producto.url_imagen_producto')
        ->get();

        return view('shop.productos', $datos); 
    }


    public function detalle($id_producto)
    {
        $datos['productos']= DB::table('producto')
        ->where('id_producto','=',$id_producto)
        ->join('imagen_producto', 'producto.id_producto', '=', 'imagen_producto.producto_id')
        ->select('producto.*', 'imagen_producto.url_imagen_producto')
        ->get();
        

        return view('shop.detalle', $datos);

    
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

    public function redirect()
    {
        $datos = Producto::paginate(3);
        $user = auth()->user();
        $count=Cart::where('phone', $user->phone)->count();

        return view('layouts.app', compact('datos', 'count'));
    }

    public function addcart(Request $request, $id)
    {
    

        if(Auth::check())
        {
                $cart=new Cart;
                $cart->id_user= Auth::user()->id;
                $cart->id_producto= $id;
                $cart->quantity=$request->quantity;
                $cart->save();
           
            return redirect()->back();
            
        }
        else {
            return redirect('/login');
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
            ->join('imagen_producto', 'carts.id_producto', '=', 'imagen_producto.producto_id')
            ->where('carts.id_user', '=', $user)
            ->select('producto.*', 'carts.id as cart_id', 'imagen_producto.url_imagen_producto', 'carts.quantity')
            ->get();

            
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

    public function ordernow(Request $request)
    {
        
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
            ->join('imagen_producto', 'carts.id_producto', '=', 'imagen_producto.producto_id')
            ->where('carts.id_user', '=', $user)
            ->select('producto.*', 'carts.id as cart_id', 'imagen_producto.url_imagen_producto', 'carts.quantity')
            ->get();

        try
            {
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
                    "cantidad_detalle_venta" => $producto->quantity,
                    "precio_detalle_venta" => ($P->precio_producto * $producto->quantity),
                    "venta_id" => $venta,
                    "producto_id" => $producto->id_producto

                    
                ]);
                if ($P->existencia_producto > $producto->quantity) {
                    $P->update(["existencia_producto" => $P->existencia_producto - $producto->quantity]);
                }

                Cart::where('id_user', $user)->delete();
            }
            DB::commit();
            return view('shop.ordernow');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('shop.cartlist');
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

    public function RecogerTienda() {
        return view('shop.thanks');

    }

    public function enviorden(Request $request) {

        $message = request()->validate([
            'address' => 'required',
            'rate' => 'required',
            'cellphone' => 'required',
            'typeSend' => 'required'
        ]);

        Mail::to('macyjlemosv@gmail.com')->send(new MailOrderDetailMailable($message));
        
        return view('shop.thanks');
        
    }


    public function search(Request $request)
    {
        
        $datos = Producto::
        join('imagen_producto', 'producto.id_producto', '=', 'imagen_producto.producto_id')
        ->where('nombre_producto', 'like', '%'.$request->input('query').'%')
        ->get();

        return view('shop.search', ['productos'=>$datos]);
        
    }

    public function orderPlace(Request $request){

        return $request->input();
    }

    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

