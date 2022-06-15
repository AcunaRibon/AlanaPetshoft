<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        return redirect()->to('/');
    }

    public function create(){
        return view('auth.login');
    }

    public function store(){
   
        if(auth()->attempt(request(['email','password'])) == false){
            return back()->withErrors([
                'message' =>'El correo o la contraseña son incorrectos. Intenta de nuevo',
            ]);
    } 
    }

    
public function authenticated($request){
    if(auth()->user()->tipo_usuario_id=='1'){
        return redirect()->route('usuario.index') ;
    }else if(auth()->user()->tipo_usuario_id=='2'){
        return redirect()->route('venta.index') ;
    }else if (auth()->user()->user_status=='0'){
        Auth::guard()->logout();

        // invalidamos su sesión
        $request->session()->invalidate();
    
        // redireccionamos a donde queremos
        return back();
    
    }else{
        return redirect()->to('/') ;
    }
}

}

