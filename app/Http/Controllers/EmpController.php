<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmpController extends Controller
{
    public function index(){

        return view('emp.index');
    }


    
}
