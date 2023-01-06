<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SendingController extends Controller
{
    //View Send
    public function index()
    {
        //Select Table
        $send = DB::table('barangs')->get();

        //Return Views
        return view('Send.send', ['send' => $send]);
    }

    
}
