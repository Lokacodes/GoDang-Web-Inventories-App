<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceivingController extends Controller
{
    //Form Transaksi
    public function Index()
    {
        return view('Transaksi.transaksi');
    }
}
