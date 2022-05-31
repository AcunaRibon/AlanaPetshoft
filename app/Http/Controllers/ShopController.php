<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailOrderDetailMailable;
use App\Models\Cart;
use App\Models\Producto;
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
        try
        {
            if(Auth::check())
            {
            $user=Auth::user()->id;
            $cart = DB::table('carts')
            ->join('producto', 'carts.id_producto', '=', 'producto.id_producto')
            ->join('imagen_producto', 'carts.id_producto', '=', 'imagen_producto.producto_id')
            ->where('carts.id_user', '=', $user)
            ->select('producto.*', 'carts.id as cart_id', 'imagen_producto.url_imagen_producto', 'carts.quantity')
            ->get();
    
            return view('shop.cartlist', ['cart'=>$cart])->with('status', 'listado');
            }
            else {
                return redirect('/login');
            }
        }
        catch(\Exception $e)
        {
            return redirect('/productos')->with('status', $e->getMessage());
        }

    }

    public function ordernow()
    {
        
        $user=Auth::id();
        $total = $cart = DB::table('carts')
        ->join('producto', 'carts.id_producto', '=', 'producto.id_producto')
        ->where('carts.id_user', '=', $user)
        ->select('producto.nombre_producto')
        ->sum('producto.precio_producto');

        return view('shop.ordernow', ['total'=>$total]);
        
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

    /*
    public function calcular_precio($productos, $cantidad,$descuento)
    {
        $precio = 0;
        foreach ($productos as $key => $producto) {
            $P = Cart::find($producto);
            $precio += ($P->precio_producto * $cantidad[$key]);
        }

        $precio = $precio-($precio * ($descuento/100));

        return view('shop.ordernow', ['precio'=>$precio]);
    }
    */


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

