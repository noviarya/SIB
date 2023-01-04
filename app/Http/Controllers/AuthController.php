<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
// use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'login',
            'active' => 'login'
        ]);
      
    }

    public function cek_login(Request $request)
    {
        $password = $request->input('password');
        $email    = $request->input('email');

            if(Auth::attempt(["email" -> $email, "password" -> $password]))
            {
                return redirect()->intended('/home')->width('success', 'Login Berhasil');
            }
            else
            {
                return redirect()->intended('/')->width('error', 'Username atau Password Salah');
            }
        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);
    
        // if (Auth::attempt ($credentials)) {
        //     $request->session()->regenerate();
    
        //     return redirect()->intended('/home');
        // }
           
    
        // return back()->withErrors('loginerror', 'login failed');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
