<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //View Supplier
    public function index()
    {
        //Retrun Views
        return view('Suply.supplier');
    }
}
