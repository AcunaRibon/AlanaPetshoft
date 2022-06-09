<?php

namespace App\Http\Controllers;

use App\Models\Domiciliario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

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
        $this->validator($request->all())->validate();
        
        $input = $request->all();
        try
        {
            DB::beginTransaction();
             Domiciliario::create([
                "documento_domiciliario" => $input["documento_domiciliario1"],
                "nombres_domiciliario" => $input["nombres_domiciliario1"],
                "apellidos_domiciliario" => $input["apellidos_domiciliario1"],
                "celular_domiciliario" => $input["celular_domiciliario1"],
                "estado_domiciliario" => $input["estado_domiciliario1"]
             ]);
            
            DB::commit();
            return redirect('/domiciliario')->with('status', 'registrado');
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
        $this->validatorUpdate($request->all())->validate();
        $input = $request->all();


        try
        {
            DB::beginTransaction();
            Domiciliario::where('documento_domiciliario', '=', $documento_domiciliario)->update([
                "nombres_domiciliario" => $input["nombres_domiciliario2"],
                "apellidos_domiciliario" => $input["apellidos_domiciliario2"],
                "celular_domiciliario" => $input["celular_domiciliario2"],
                "estado_domiciliario" => $input["estado_domiciliario2"]
            ]);
            DB::commit();
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
    
       
        try
        {
            DB::beginTransaction();
            Domiciliario::destroy($documento_domiciliario);
            DB::commit();
            return redirect()->route('domiciliario.index')->with('status', 'cancelado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/domiciliario')->with('status', $e->getMessage());
        }
    }

    public function validator( array $input){
        return Validator::make($input, [
         'documento_domiciliario1' => ['required', 'max:10' , 'min:10'],
        'nombres_domiciliario1'=>['required'],
         'apellidos_domiciliario1'=>['required'],
        'celular_domiciliario1'=>['required' ,'max:10' , 'min:10'],
        'estado_domiciliario1'=>['required'],
      
    ]);
    }

    public function validatorUpdate( array $input){
        return Validator::make($input, [
            'nombres_domiciliario2'=>['required'],
            'apellidos_domiciliario2'=>['required'],
           'celular_domiciliario2'=>['required' ,'max:10' , 'min:10'],
           'estado_domiciliario2'=>['required'],
      
    ]);
    }
}
