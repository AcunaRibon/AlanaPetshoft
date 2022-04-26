<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoUsuario;
use Illuminate\Support\Facades\DB;

class TipoUsuarioController extends Controller
{

    public function index()
    {
        $total = TipoUsuario::select("tipo_usuario.*")->count();
        $tipo_usuario=TipoUsuario::paginate(10);
        return view('crud.usuario.tipoUsuario.index', compact('tipo_usuario', 'total'))->with('status', 'listado');
    }

    public function create()
    {
        return view('tipoUsuario.index');
    }

    public function edit($id)
    {
        return view('tipoUsuario.form');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        try
        {
            DB::beginTransaction();

            $tipou = TipoUsuario::findOrFail($id);
            $tipou -> nombre_tipo_usuario = $input["nombre_tipo_usuario"];
            $tipou -> update();

            DB::commit();

            return redirect('tipoUsuario')->with('status', 'actualizado');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect('/tipoUsuario')->with('status', $e->getMessage());
        }
    }

    public function show()
    {
        return view('tipoUsuario.form');
    }


    public function store(Request $request)
    {
        $input = request()->all();

        try {
            DB::beginTransaction();

            TipoUsuario::create([
                "nombre_tipo_usuario" => $input['nombre_tipo_usuario']
            ]);

            DB::commit();

            return redirect("/tipoUsuario")->with('status', 'registrado');
        } 
        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect("/tipoUsuario")->with('status', $e->getMessage());
        }


    } 

    public function destroy($id)
    {

    }
}