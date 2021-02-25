<?php

namespace App\Http\Controllers\Back;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class AuthController extends Controller
{
    public function login(){
        return view('back.auth.login');
    }

    public function loginPost(Request $request){

        //dd($request->post());
        if(Auth::attempt(['email' =>$request->email, 'password' => $request->password])){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors('Email adresi veya şifre hatalı');
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
