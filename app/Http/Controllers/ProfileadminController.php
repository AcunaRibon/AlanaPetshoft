<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class ProfileadminController extends Controller
{
  
    public function index()
    {
        $usuarios['users']=User::all();
        return view('crud.usuario.profileadmin.index',$usuarios);
    }

    
    public function update(Request $request, $id)
    {

        $usuarios = $request->all();

        DB::beginTransaction();
        User::where('id', '=', $id)->update([

            "name" => $usuarios['name'],
            "last_name" => $usuarios['last_name'],
            "email" => $usuarios['email'],
            'password' => Hash::make($usuarios['password']),
            "cellphone" => $usuarios['cellphone'],
            "address" => $usuarios['address']
        ]);

        DB::commit();

        return redirect("/profileadmin")->with('status', 'actualizado');
    }
}


   
    

    

  
