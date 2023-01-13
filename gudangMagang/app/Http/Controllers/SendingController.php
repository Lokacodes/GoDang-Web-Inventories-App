<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ekspedisi;
use App\Models\sending;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $response[] = array("value"=>$barang->nama_barang, "label1"=>$barang->kode_barang, "label2"=>$barang->stok_barang, "label3"=>$barang->harga_beli, "label4"=>$barang->harga_jual, "label5"=>$barang->kode_supplier);
        }
        
         return response()->json($response);
    }

    public function kurir(Request $request)
    {
        $search=$request->search;
        if($search==''){
            $kurir=ekspedisi::orderBy('nama_ekspedisi', 'asc')
                ->select('kode_ekspedisi', 'nama_ekspedisi', 'ongkir')
                ->get();
        }else{
            $kurir=ekspedisi::orderBy('nama_ekspedisi', 'asc')
                ->select('kode_ekspedisi', 'nama_ekspedisi', 'ongkir')
                ->where('nama_ekspedisi','like','%'.$search.'%')
                ->get();
        }

        $response = array();
        foreach($kurir as $kurir){
            $response[] = array("value"=>$kurir->nama_ekspedisi, "kode"=>$kurir->kode_ekspedisi, "ongkir"=>$kurir->ongkir);
        }
        
         return response()->json($response);
    }

    public function sendingStore(Request $request)
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
                $sending = new Sending();
                $sending->kode_pengiriman = $request->nomor[$i];
                $sending->kode_barang = $request->kode_barang[$i];
                $sending->jumlah_barang = $request->jumlah_dibeli[$i];
                // dd($sending);
                $sending->save();

                //$cari = $request->kode_barang[$i];

                $sendingFind = $sending->kode_barang;
                $barang = Barang::where('kode_barang',$sendingFind)->first();
                $jumlahSend = ((float)($barang->stok_barang))-((float)($sending->jumlah_barang));
                $barang->stok_barang = $jumlahSend;
                //dd($barang);

                $barang->save();
            // /* To send Notification in admin notice board after sending */
            // $user = User::where('username','admin')->get();
            // Notification::send($user,new sendingComplete($request->product_name));

            }
           
            return redirect('/sending');
        }
    }

    
}