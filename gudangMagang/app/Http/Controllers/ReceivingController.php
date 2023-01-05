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
        $receive = DB::table('barangs')->get();

        //Return Views
        return view('Receive.receive', ['receive'=>$receive]);
    }

    //Search
    public function searchbarang(Request $request)
    {
        $search=$request->search;
        if($search==''){
            $cari=DB::table('barangs')->orderBy('nama_barang', 'asc')
                ->join('brands', 'brands.kode_brand', '=', 'barangs.kode_brand')
                ->select('nama_barang', 'nama_brand', 'stok_barang')
                ->get();
        }else{
            $cari=DB::table('barangs')->orderBy('nama_barang', 'asc')
                ->join('brands', 'brands.kode_brand', '=', 'barangs.kode_brand')
                ->select('nama_barang', 'nama_brand', 'stok_barang')
                ->where('nama_barang','like','%'.$search.'%')
                ->get();
        }

        $response = array();
        foreach($cari as $barang){
            $response[] = array("value"=>$barang->nama_barang, "brand"=>$barang->nama_brand, "stok"=>$barang->stok_barang);
        }
        
         return response()->json($response);
    }
}
