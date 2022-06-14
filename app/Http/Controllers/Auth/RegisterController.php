<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        return redirect()->to('/');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30', 'min:3'],
            'last_name' => ['required', 'string', 'max:30','min:3'],
            'email' => ['required', 'string', 'email', 'max:40', 'unique:users'],
            'password' => ['required', 'string', 'min:10', 'max:30', 'confirmed'],
            'cellphone' => ['required', 'string', 'min:10', 'max:10'],
            'address' => ['required', 'string', 'max:70']
        ]);

  
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        Cliente::create([
            'nombres_cliente' => $data['name'],
            'apellidos_cliente'=>$data['last_name'],
            'correo_electronico_cliente'=>$data['email'],
            'celular_cliente'=>$data['cellphone'],
            'direccion_cliente'=>$data['address'],
            'estado_cliente'=>'1'
            
                    ]);

        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cellphone' => $data['cellphone'],
            'address' => $data['address']
        ]);

       
    }


    
}

