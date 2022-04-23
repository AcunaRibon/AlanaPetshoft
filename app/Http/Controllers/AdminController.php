<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(){

        $usuarios['users']=User::paginate(20);
        return view('admin.index',$usuarios);
    }

    public function create(){
        return view('admin.index');
    }

    public function edit($id){


        return view('admin.form');
    }

    public function update(Request $request, $id){

        $usuarios=request()->except(['_token','_method']);
        User::where('id','=',$id)->update($usuarios);

        // $usuarios=User::findOrFail($id);
        return redirect('admin');
    }

    public function show(){
        return view('admin.form');
    }
    

    public function store(Request $request){
        
        $input = request()->all();


        try {

            DB::beginTransaction();

            $usuarios = User::create([
                "name" => $input['name'],
                "last_name" => $input['last_name'],
                "email" => $input['email'],
                "password" => $input['password'],
                "cellphone" => $input['cellphone'],
                "address" => $input['address'],
                "user_status" => $input['user_status'],
                "tipo_usuario_id" => $input['tipo_usuario_id']


            ]);
        

            DB::commit();
            return redirect("/admin")->with('status', '1');;
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/admin")->with('status', $e->getMessage());
        }

        
    } 

    public function destroy($id){
       
        User::destroy($id);

        return redirect('admin');
    }
    
    
}
