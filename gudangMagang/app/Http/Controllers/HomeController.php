<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Dashboard
    public function index()
    {
        return view('Home.dashboard');
    }

}
