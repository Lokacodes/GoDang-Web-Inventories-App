<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceivingController extends Controller
{
    //View Receiving
    public function index()
    {
        $receive = DB::table('barangs')->get();

        return view('Receive.receive', ['receive'=>$receive]);
    }
}
