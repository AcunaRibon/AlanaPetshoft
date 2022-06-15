<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function index()
    {
        $usuarios['users']=DB::table('users')
        ->select('users.*')
        ->where('user_status', '=', '1')
        ->get();



        $total = User::count();
    

        $usuarios['usuarioscancelados'] = DB::table('users')
            ->select('users.*')
            ->where('user_status', '=', '0')
            ->get();

            return view('crud.usuario.usuario.index',$usuarios, compact('usuarios', 'total'));
    }

    public function create()
    {
        return view('usuario.index');
    }

    public function edit($id)
    {

        return view('usuario.form');
    }

    public function update(Request $request, $id)
    {

        $usuarios=$request->all();

        $cliente=Cliente::where('correo_electronico_cliente','=', $usuarios['email'])->first();


        try
        {
            DB::beginTransaction();
            User::where('id','=',$id)->update([
              
                "name" => $usuarios['name'],
                "last_name" => $usuarios['last_name'],
                "email" => $usuarios['email'],
                'password' => Hash::make($usuarios['password']),
                "cellphone" => $usuarios['cellphone'],
                "address" => $usuarios['address'],
                "user_status" => $usuarios['user_status'],
                "tipo_usuario_id" => $usuarios['tipo_usuario_id']
                    
                          
            ]);

     if(isset($cliente)){
            if($usuarios['tipo_usuario_id'] == '3'){

                Cliente::where('id_cliente','=',$cliente->id_cliente)->update([
                    'nombres_cliente' => $usuarios['name'],
                    'apellidos_cliente'=>$usuarios['last_name'],
                    'correo_electronico_cliente'=>$usuarios['email'],
                    'celular_cliente'=>$usuarios['cellphone'],
                    'direccion_cliente'=>$usuarios['address'],
                    'estado_cliente'=>$usuarios['user_status']
                    
                            ]);
               }else{
                Cliente::where('id_cliente','=',$cliente->id_cliente)->update([
                    'estado_cliente'=>'0'
                    
                            ]);
               }
            }
        

            DB::commit();

            return redirect('/usuario')->with('status', 'actualizado');
        }
        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect("/usuario")->with('status', $e->getMessage());
        }
    }

    public function show()
    {
        return view('usuario.form');
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
       if($input['tipo_usuario_id'] == '3'){

        Cliente::create([
            'nombres_cliente' => $input['name'],
            'apellidos_cliente'=>$input['last_name'],
            'correo_electronico_cliente'=>$input['email'],
            'celular_cliente'=>$input['cellphone'],
            'direccion_cliente'=>$input['address'],
            'estado_cliente'=>'1'
            
                    ]);
       }


            DB::commit();
            return redirect("/usuario")->with('status', 'registrado');;
        } 
        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect("/usuario")->with('status', $e->getMessage());
        }
    } 

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $cancelados = User::find($id);

            if($cancelados->user_status == 0) {
                User::where('id', '=', $cancelados->id)->update([
                    "user_status" => 1
                ]);
                $statusValidator = "restaurado";
            }else{
                User::where('id', '=', $cancelados->id)->update([
                    "user_status" => 0
                ]);
                $statusValidator = "cancelado";
            }

            DB::commit();
            return redirect("/usuario")->with('status', $statusValidator);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/usuario")->with('status', $e->getMessage());
        }
    }

    public function report()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function adminlte_profile_url(){
        return 'profile/username';
    }
}
