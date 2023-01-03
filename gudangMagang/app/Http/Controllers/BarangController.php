<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    //List Barang
    public function Index()
    {
        
        return view('Barang.list');
    }


}
