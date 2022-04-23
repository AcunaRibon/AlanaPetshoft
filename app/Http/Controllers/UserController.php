<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function index(){

        $usuarios['users']=User::all();
        $total = User::count();
        return view('crud.usuario.usuario.index',$usuarios, compact('usuarios', 'total'));
    }

    public function create(){
        return view('usuario.index');
    }

    public function edit($id){

        return view('usuario.form');
    }

    public function update(Request $request, $id){

        $usuarios=request()->except(['_token','_method']);
        User::where('id','=',$id)->update($usuarios);

        // $usuarios=User::findOrFail($id);
        return redirect('usuario');
    }

    public function show(){
        return view('usuario.form');
    }
    

    public function store(Request $request){
        
        $input = request()->all();


        try {

            DB::beginTransaction();

            $usuarios = User::create([
                "name" => $input['name'],
                "last_name" => $input['last_name'],
                "email" => $input['email'],
                'password' => Hash::make($input['password']),
                "cellphone" => $input['cellphone'],
                "address" => $input['address'],
                "user_status" => $input['user_status'],
                "tipo_usuario_id" => $input['tipo_usuario_id']

                

            ]);
           

            DB::commit();
            return redirect("/usuario")->with('status', '1');;
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/usuario")->with('status', $e->getMessage());
        }

        
    } 

    public function destroy($id){
       
        User::destroy($id);

        return redirect('usuario');
    }

    public function report(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    
    
}
