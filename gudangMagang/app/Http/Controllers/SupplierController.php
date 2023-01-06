<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    //View Supplier
    public function index()
    {
        //Retrun Views
        return view('Suply.supplier');
    }

    //Search Supplier
    public function search(Request $request)
    {
        //Variable
        $cari = $request->cari;

        //Request To Table
        $supplier = DB::table('suppliers')
                ->where('nama_supplier', 'like', "%" . $cari . "%");

        //Retrun Views
        return view('Suply.supplier', ['supplier' => $supplier]);
    }
}
