<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ekspedisi;
use App\Models\sending;
use App\Models\sent;
use App\Models\TransaksiKirim;
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
        $stokKurang = 0;

        //Return Views

        $autoId = DB::table('sendings')->select(DB::raw('MAX(RIGHT(kode_pengiriman,4)) as autoId'));
        $kd = "";
        if($autoId->count()>0){
            foreach($autoId->get() as $a){
                $tmp = ((int)$a->autoId)+1;
                $kd = sprintf("%04s",$tmp);
            }
        }   else{
            $kd = "0001";
        }

        return view('Send.send', compact('kd','send','stokKurang'));
    }

    //Barang
    public function barang(Request $request)
    {
        $search=$request->search;
        if($search==''){
            $barang=Barang::orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_barang', 'stok_barang', 'harga_jual', 'harga_beli', 'kode_supplier','berat_barang')
                ->get();
        }else{
            $barang=Barang::orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_barang', 'stok_barang', 'harga_jual', 'harga_beli', 'kode_supplier','berat_barang')
                ->where('nama_barang','like','%'.$search.'%')
                ->get();
        }

        $response = array();
        foreach($barang as $barang){
            $response[] = array("value"=>$barang->nama_barang, "label1"=>$barang->kode_barang, "label2"=>$barang->stok_barang, "label3"=>$barang->harga_beli, "label4"=>$barang->harga_jual, "label5"=>$barang->kode_supplier,"berat"=>$barang->berat_barang);
        }
        
         return response()->json($response);
    }

    public function kurir(Request $request)
    {
        $search=$request->search;
        if($search==''){
            $kurir=ekspedisi::orderBy('nama_ekspedisi', 'asc')
                ->select('kode_ekspedisi', 'nama_ekspedisi')
                ->get();
        }else{
            $kurir=ekspedisi::orderBy('nama_ekspedisi', 'asc')
                ->select('kode_ekspedisi', 'nama_ekspedisi')
                ->where('nama_ekspedisi','like','%'.$search.'%')
                ->get();
        }

        $response = array();
        foreach($kurir as $kurir){
            $response[] = array("value"=>$kurir->nama_ekspedisi, "kode"=>$kurir->kode_ekspedisi);
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
            return redirect()->back()->with($errorNotice);
        }
        else{
            $count_barang = count($request->kode_barang);
            for ($i=0; $i < $count_barang; $i++) {
                if($request->sisa[$i] <= 0 ){
                    // dd($request);
                    return redirect('/sending')->with('alert', 'Stok Habis!');;
                }else {
                $sending = new Sending();
                $sending->kode_pengiriman = $request->kode_sending[$i];
                $sending->kode_barang = $request->kode_barang[$i];
                $sending->jumlah_barang = $request->jumlah_dibeli[$i];
                // dd($sending);
                $sending->save();
                }
                
                // $sent = new sent();
                // $sent->kode_pengiriman = $request->kode_sending[$i];
                // $sent->kode_barang = $request->kode_barang[$i];
                // $sent->jumlah_barang = $request->jumlah_dibeli[$i];
                // $sent->kode_ekspedisi = $request->kurir[$i];
                // // dd($sending);
                // $sent->save();

                //$cari = $request->kode_barang[$i];

                $sendingFind = $sending->kode_barang;
                $barang = Barang::where('kode_barang',$sendingFind)->first();
                $jumlahSend = ((float)($barang->stok_barang))-((float)($sending->jumlah_barang));
                // if ($jumlahSend <= 0){
                //     $stokKurang = 1;
                //     return view('Send.send');
                // }
                $barang->stok_barang = $jumlahSend;
                //dd($barang);
                $barang->save();


            // /* To send Notification in admin notice board after sending */
            // $user = User::where('username','admin')->get();
            // Notification::send($user,new sendingComplete($request->product_name));

            }

            $transaksi = new TransaksiKirim();
                $transaksi->kode_pengiriman = $request->kode_send;
                $transaksi->tanggal_transaksi = $request->tanggal;
                $transaksi->nama_pelanggan = $request->nama_pel;
                $transaksi->alamat_pelanggan = $request->alamat_pel;
                $transaksi->catatan = $request->catatan;
                $transaksi->kode_ekspedisi = $request->cari_kurir;
                $transaksi->berat_total = $request->total_berat;
                $transaksi->beli_total = $request->total_beli;
                $transaksi->harga_total = $request->total_harga;
                $transaksi->ongkir = $request->ongkir;

                $transaksi->save();
           
            return redirect('/sending')->with('alert', 'Data Pengiriman telah Disimpan');
        }
    }

    
}