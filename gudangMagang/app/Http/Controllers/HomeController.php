<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiKirim;
use App\Models\TransaksiTerima;

class HomeController extends Controller
{
    // Dashboard
    public function index()
    {
        //Count Table
        $barang = Barang::count();
        $receive = TransaksiTerima::count();
        $sending = TransaksiKirim::count();

        //Return Views
        return view('Home.dashboard', ['barang'=>$barang, 'receive'=>$receive,'sending'=>$sending]);
    }
}
