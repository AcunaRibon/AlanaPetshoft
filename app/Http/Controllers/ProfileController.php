<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{

    public function index()
    {
        $usuarios['users'] = User::all();
        return view('crud.usuario.profile.index', $usuarios);
    }

    public function update(Request $request, $id)
    {

        $usuarios = $request->all();

        $cliente = Cliente::where('correo_electronico_cliente', '=', $usuarios['email'])->first();



        DB::beginTransaction();
        User::where('id', '=', $id)->update([

            "name" => $usuarios['name'],
            "last_name" => $usuarios['last_name'],
            "email" => $usuarios['email'],
            'password' => Hash::make($usuarios['password']),
            "cellphone" => $usuarios['cellphone'],
            "address" => $usuarios['address'],



        ]);
        Cliente::where('id_cliente', '=', $cliente->id_cliente)->update([
            'nombres_cliente' => $usuarios['name'],
            'apellidos_cliente' => $usuarios['last_name'],
            'correo_electronico_cliente' => $usuarios['email'],
            'celular_cliente' => $usuarios['cellphone'],
            'direccion_cliente' => $usuarios['address']

        ]);

        DB::commit();

        return redirect("/profile")->with('status', 'actualizado');
    }
}
