<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Receiving;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Dashboard
    public function index()
    {
        //Count Table
        $barang = Barang::count();
        $receive = Receiving::count();

        //Return Views
        return view('Home.dashboard', ['barang'=>$barang, 'receive'=>$receive]);
    }

}
