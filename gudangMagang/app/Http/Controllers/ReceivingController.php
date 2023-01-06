<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceivingController extends Controller
{
    //View Receiving
    public function index()
    {
        //Select Table
        $receive = DB::table('suppliers')->get();

        //Return Views
        return view('Receive.receive', ['receive'=>$receive]);
    }

    //Search
    public function searchsupply(Request $request)
    {
        $search=$request->search;
        if($search==''){
            $cari=DB::table('suppliers')->orderBy('nama_supplier', 'asc')
                ->select('nama_supplier', 'kode_supplier', 'alamat')
                ->get();
        }else{
            $cari=DB::table('suppliers')->orderBy('nama_supplier', 'asc')
                ->select('nama_supplier', 'kode_supplier', 'alamat')
                ->where('nama_supplier','like','%'.$search.'%')
                ->get();
        }

        $response = array();
        foreach($cari as $suppli){
            $response[] = array("value"=>$suppli->nama_supplier, "kode"=>$suppli->kode_supplier, "alamat"=>$suppli->alamat);
        }
        
         return response()->json($response);
    }

    //Barang
    public function inputbarang(Request $request)
    {
        $search=$request->search;
        if($search==''){
            $cari=DB::table('barang')->orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_supplier', 'stok_barang', 'harga_jual', 'harga_beli', 'kode_supplier')
                ->get();
        }else{
            $cari=DB::table('barang')->orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_supplier', 'stok_barang', 'harga_jual', 'harga_beli', 'kode_supplier')
                ->where('nama_barang','like','%'.$search.'%')
                ->get();
        }

        $response = array();
        foreach($cari as $barang){
            $response[] = array("value"=>$barang->nama_barang, "kode"=>$barang->kode_barang, "beli"=>$barang->harga_beli, "jual"=>$barang->harga_jual, "stok"=>$barang->stok_barang, "supply"=>$barang->kode_supplier);
        }
        
         return response()->json($response);
    }
}
