<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoUsuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TipoUsuarioController extends Controller
{
    public function index(){

        $tipou['tipo_usuario']=TipoUsuario::paginate(10);
        return view('tipoUsuario.index',$tipou);
    }


public function create(){
return view('tipoUsuario.index');
}

public function edit($id){

return view('tipoUsuario.form');
}

public function update(Request $request, $id){

$tipou=request()->except(['_token','_method']);
TipoUsuario::where('id_tipo_usuario','=',$id)->update($tipou);

// $usuarios=User::findOrFail($id);
return redirect('tipoUsuario');
}

public function show(){
return view('tipoUsuario.form');
}


public function store(Request $request){

$input = request()->all();


try {

    DB::beginTransaction();

    $tipou = TipoUsuario::create([
        "id_tipo_usuario" => $input['id_tipo_usuario'],
        "nombre_tipo_usuario" => $input['nombre_tipo_usuario']
     
    ]);


    DB::commit();
    return redirect("/tipoUsuario")->with('status', '1');;
} catch (\Exception $e) {
    DB::rollBack();
    return redirect("/tipoUsuario")->with('status', $e->getMessage());
}


} 

public function destroy($id){

User::destroy($id);

return redirect('tipoUsuario');
}


}