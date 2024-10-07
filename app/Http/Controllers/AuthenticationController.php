<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    
    public function register()
    {
        return view("auth.register");
    }

    public function forgetPassword()
    {
        return view("auth.forget-password");
    }

    public function logout(Request $request)
    {
        $request->session()->forget("token");
        return redirect("/");
    }
}
