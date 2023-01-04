<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SendingController extends Controller
{
    //View Send
    public function index()
    {
        $send = DB::table('barangs')->get();

        return view('Send.send', ['send' => $send]);
    }
}
