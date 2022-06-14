<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
  
    public function index()
    {
        $usuarios['users']=User::all();
        return view('crud.usuario.profile.index',$usuarios);
    }

    public function create()
    {
        return view('profile.index');
    }

    public function edit($id)
    {

        return view('profile.form');
    }

    public function update(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();

            $usuarios=request()->except(['_token','_method']);
            User::where('id','=',$id)->update($usuarios);

            DB::commit();

            return redirect('/profile')->with('status', 'actualizado');
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect("/profile")->with('status', $e->getMessage());
        }
    }

    public function show()
    {
        return view('profile.form');
    }
    

    public function store(Request $request)
    {
        $input = request()->all();

        try 
        {

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
            return redirect("/profile")->with('status', 'registrado');;
        } 
        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect("/profile")->with('status', $e->getMessage());
        }
    } 

    public function destroy($id)
    {

    }

  
}