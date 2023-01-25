<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //View Login
    public function index()
    {
        return view('Login.user');
    }

    //Auth Login
    public function auth(Request $request)
    {
        //Validate
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //Authenticate
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
           return redirect()->intended('/');

        }

        //Return Views
        return redirect()->intended('/login');
    }

    //Registrasi Process
    public function registrasi(Request $request)
    {
        //Create Table
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        //Return Views
        return redirect('/login')->with('alert', 'Pendaftaran Berhasil');
    }

    //Log Out Process
    public function logout(Request $request)
    {
        //Validate
        Auth::logout();

        //Session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        //Return Views
        return redirect('/login')->with('alert', 'Telah Berhasil Log Out');
    }
}
