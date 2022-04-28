<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Producto;
use App\Models\ImagenProducto;
use App\Models\TipoProducto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductoExport;
use PhpParser\Node\Stmt\TryCatch;

class ProductoController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductoExport, 'productos.xlsx');
    }

    public function index()
    {
        $datos['tipoProductos'] = TipoProducto::all();

        $datos['imagenes']=ImagenProducto::all();
        $datos['Existencia'] = Producto::select("*")
            ->where("estado_producto", "=", 1)
            ->count();

        $datos['productos'] = DB::table('producto')
            ->where("estado_producto", "=", 1)
            ->join('tipo_producto', 'producto.tipo_producto_id', '=', 'tipo_producto.id_tipo_producto')
            ->select('producto.*',  'tipo_producto.nombre_tipo_producto', 'tipo_producto.id_tipo_producto')
            ->get();

        $datos['productosInactivos'] = DB::table('producto')
            ->where('estado_producto', 0)

            ->join('tipo_producto', 'producto.tipo_producto_id', '=', 'tipo_producto.id_tipo_producto')
            ->select('producto.*',  'tipo_producto.nombre_tipo_producto', 'tipo_producto.id_tipo_producto')
            ->get();

        return view('crud.producto.gestionProducto.index', $datos);
    }


    public function store(Request $request)
    {

        $this->validator($request->all())->validate();
        $input = request()->all();

        try {

            DB::beginTransaction();

            $producto = Producto::insertGetId([
                "nombre_producto" => $input['nombre_producto'],
                "precio_producto" => $input['precio_producto'],
                "estado_producto" => $input['estado_producto'],
                "tipo_producto_id" => $input['tipo_producto_id'],
                "existencia_producto" => 0
            ]);

            if ($request->hasFile('url_imagen_producto')) {

                $imagenes = $request->file('url_imagen_producto');
                foreach ($imagenes as $imagen) {

                    
                    
                    $path=$imagen->store('uploads','public');

                    

                    ImagenProducto::create([
                        'url_imagen_producto' => $path,
                        'producto_id' =>  $producto
                    ]);
                }
            }

            DB::commit();
            return redirect("/producto")->with('status', '1');;
        } catch (\Exception $e) {
            DB::rollBack();

            $imagenes = $request->file('url_imagen_producto');
            foreach ($imagenes as $imagen) {

                Storage::delete('public/uploads'.$imagen->getClientOriginalName());
                
            }

            return redirect("/producto")->with('status', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        $input = request()->all();

        try {
            DB::beginTransaction();


            Producto::where('id_producto', '=', $id)->update([
                "nombre_producto" => $input['nombre_producto'],
                "precio_producto" => $input['precio_producto'],
                "estado_producto" => $input['estado_producto'],
                "tipo_producto_id" => $input['tipo_producto_id']
            ]);

            if ($request->hasFile('url_imagen_producto')) {
                $imagenes = $request->file('url_imagen_producto');
                foreach ($imagenes as $imagen) {
                   
                    $path=$imagen->store('uploads','public');
                    ImagenProducto::create([
                        'url_imagen_producto' => $path,
                        'producto_id' =>  $id
                    ]);
                }
            }

            DB::commit();
            return redirect("/producto")->with('status', '1');
        } catch (\Exception $e) {
            DB::rollBack();
            
            $imagenes = $request->file('url_imagen_producto');
            foreach ($imagenes as $imagen) {

                Storage::delete('public/uploads'.$imagen->getClientOriginalName());
                
            }
            return redirect("/producto")->with('status', $e->getMessage());
        }
    }


    public function destroy($id)
    {

        try {
            DB::beginTransaction();
            $prod = Producto::find($id);
            if ($prod->estado_producto == 0) {
                Producto::where('id_producto', '=', $prod->id_producto)->update([
                    "estado_producto" => 1
                ]);
            } else if ($prod->estado_producto == 1) {
                Producto::where('id_producto', '=', $prod->id_producto)->update([
                    "estado_producto" => 0
                ]);
            }

            DB::commit();
            return redirect("/producto")->with('status', '1');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/producto")->with('status', $e->getMessage());
        }
    }

    public function destroyImg($id){
        $imagen=ImagenProducto::where('id_imagen_producto','=',$id)->first();
        try{
            DB::beginTransaction();
            ImagenProducto::where('id_imagen_producto','=',$id)->delete();
            Storage::delete('public/'.$imagen->url_imagen_producto);
            DB::commit();
            return redirect("/producto")->with('status', '1');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect("/producto")->with('status', $e->getMessage());
        }
    }

    public function validator(array $input)
    {
        return Validator::make($input, [
            'nombre_producto' => ['required', 'max:26'],
            'precio_producto' => ['required', 'int', 'max:999999', 'min:50'],
            'url_imagen_producto.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']

        ]);
    }
}
