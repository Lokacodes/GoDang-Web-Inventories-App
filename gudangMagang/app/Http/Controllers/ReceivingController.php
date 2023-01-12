<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Receiving;

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
            $cari=DB::table('suppliers')->orderBy('kode_supplier', 'asc')
                ->select('nama_supplier', 'kode_supplier', 'alamat')
                ->get();
        }else{
            $cari=DB::table('suppliers')->orderBy('kode_supplier', 'asc')
                ->select('nama_supplier', 'kode_supplier', 'alamat')
                ->where('kode_supplier','like','%'.$search.'%')
                ->get();
        }

        $response = array();
        foreach($cari as $suppli){
            $response[] = array("value"=>$suppli->kode_supplier, "nama"=>$suppli->nama_supplier, "alamat"=>$suppli->alamat);
        }
        
         return response()->json($response);
    }

    //Barang
    public function barang(Request $request)
    {
        $search=$request->search;
        if($search==''){
            $barang=Barang::orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_barang', 'stok_barang', 'harga_jual', 'harga_beli', 'kode_supplier')
                ->get();
        }else{
            $barang=Barang::orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_barang', 'stok_barang', 'harga_jual', 'harga_beli', 'kode_supplier')
                ->where('nama_barang','like','%'.$search.'%')
                ->get();
        }

        $response = array();
        foreach($barang as $barang){
            $response[] = array("value"=>$barang->nama_barang, "label1"=>$barang->kode_barang, "label2"=>$barang->stok_barang, "label3"=>$barang->kode_supplier, "label4"=>$barang->harga_jual);
        }
        
         return response()->json($response);
    }

    public function receivingStore(Request $request)
    {
        if($request->kode_barang == null){

            $errorNotice = array(
                'message'=>'Sorry, You Do not select any item',
                'alert-type'=>'error',
            );
            dd($request);
            return redirect()->back()->with($errorNotice);
        }
        else{
            $count_barang = count($request->kode_barang);
            for ($i=0; $i < $count_barang; $i++) {
                $receive = new Receiving();
                $receive->kode_receive = $request->nomor[$i];
                $receive->kode_barang = $request->kode_barang[$i];
                $receive->kode_supplier = $request->kode_supplier[$i];
                $receive->jumlah_barang = $request->jumlah[$i];
                $receive->tanggal_receive = $request->tanggal;
                //dd($request);
                $receive->save();
                


            // /* To send Notification in admin notice board after purchase */
            // $user = User::where('username','admin')->get();
            // Notification::send($user,new PurchaseComplete($request->product_name));

            }

           
            return redirect('/receiving');
        }
    }

    //Table Gudang
    // public function table(Request $request)
    // {
    //     $receive = Receiving::create($request->all());
    //     $kode_barang = $request->input('kode_barang', []);
    //     $jumlah = $request->input('jumlah', []);
    //     $total = $request->input('total', []);
    //     //  dd($request);
    //     for ($i=0; $i < count($kode_barang); $i++) {
    //         if ($kode_barang[$i] != '') {
    //             $receive->receive()->attach($kode_barang[$i],['jumlah' => $jumlah[$i]]);
    //             Barang::updateOrCreate(['kode_barang' => $kode_barang],['stok_barang'=> $total[$i]]);
    //         }
    //     }
    
    //     return \redirect('/receiving');

    // }

}
