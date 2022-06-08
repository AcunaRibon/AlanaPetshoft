<?php

namespace App\Http\Controllers;

use App\Models\estadoVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class EstadoVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $estadoVenta = estadoVenta::all();
            $total = estadoVenta::count();
            return view('crud.venta.estadoVenta.index', compact('estadoVenta', 'total'))->with('status', 'listado');
        } catch (\Exception $e) {
            return redirect('/estadoVenta')->with('status', $e->getMessage());
        }
    }


    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $input = $request->all();

        try {
            DB::beginTransaction();
            estadoVenta::create([
                "nombre_estado_venta" => $input["nombre_estado_venta1"]
            ]);
            DB::commit();
            return redirect()->route('estadoVenta.index')->with('status', 'registrado');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/estadoVenta')->with('status', $e->getMessage());
        }
    }


    public function update(Request $request, $id_estado_venta)
    {
        $this->validatorUpdate($request->all())->validate();
        $input = $request->all();

        try {

            DB::beginTransaction();
            estadoVenta::where('id_estado_venta', '=', $id_estado_venta)->update([
                "nombre_estado_venta" => $input["nombre_estado_venta2"]
            ]);
            DB::commit();
            return redirect()->route('estadoVenta.index')->with('status', 'actualizado');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/estadoVenta')->with('status', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estadoVenta  $estadoVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_estado_venta)
    {
        try {
            estadoVenta::destroy($id_estado_venta);
            return redirect()->route('estadoVenta.index')->with('status', 'cancelado');
        } catch (\Exception $e) {
            return redirect('/estadoVenta')->with('status', $e->getMessage());
        }
    }

    public function validator(array $input)
    {
        return Validator::make($input, [

            'nombre_estado_venta1' => ['required','regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/' ]


        ]);
    }

    public function validatorUpdate(array $input)
    {
        return Validator::make($input, [

            'nombre_estado_venta2' => ['required','regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/']


        ]);
    }
}
