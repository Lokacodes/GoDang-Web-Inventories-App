<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('Login.user');
    }

    //Auth Login
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //dd('login');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
           return redirect()->intended('/');

        }

        return redirect()->intended('/login');
    }

    //Registrasi Process
    public function registrasi(Request $request)
    {
        //dd($request->all());

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        return redirect('/login');
    }

    //Log Out Process
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
