<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ekspedisi;
use App\Models\Sending;
use App\Models\TransaksiKirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SendingController extends Controller
{
    //View Send
    public function index()
    {
        //Select Table
        $send = DB::table('barangs')->get();
        $stokKurang = 0;

        $autoId = DB::table('sendings')->select(DB::raw('MAX(RIGHT(kode_pengiriman,4)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        return view('Send.send', compact('kd', 'send', 'stokKurang'));
    }

    //Search Barang
    public function barang(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $barang = Barang::orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_barang', 'stok_barang', 'harga_jual', 'status_barang', 'kode_supplier', 'berat_barang')
                ->where('status_barang', '=', '1')
                ->get();
        } else {
            $barang = Barang::orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_barang', 'stok_barang', 'harga_jual', 'status_barang', 'kode_supplier', 'berat_barang')
                ->where('status_barang', '=', '1')
                ->where('nama_barang', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($barang as $barang) {
            $response[] = array("value" => $barang->nama_barang, "label1" => $barang->kode_barang, "label2" => $barang->stok_barang, "label3" => $barang->harga_beli, "label4" => $barang->harga_jual, "label5" => $barang->kode_supplier, "berat" => $barang->berat_barang);
        }

        return response()->json($response);
    }

    //Search Ekpedisisi
    public function kurir(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $kurir = ekspedisi::orderBy('nama_ekspedisi', 'asc')
                ->select('kode_ekspedisi', 'nama_ekspedisi', 'status')
                ->where('status', '=', '1')
                ->get();
        } else {
            $kurir = ekspedisi::orderBy('nama_ekspedisi', 'asc')
                ->select('kode_ekspedisi', 'nama_ekspedisi', 'status')
                ->where('status', '=', '1')
                ->where('nama_ekspedisi', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($kurir as $kurir) {
            $response[] = array("value" => $kurir->nama_ekspedisi, "kode" => $kurir->kode_ekspedisi);
        }

        return response()->json($response);
    }

    //Save Sending
    public function sendingStore(Request $request)
    {
        if ($request->kode_barang == null) {

            $errorNotice = array(
                'message' => 'Sorry, You Do not select any item',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($errorNotice);
        } else {
            $count_barang = count($request->kode_barang);
            for ($i = 0; $i < $count_barang; $i++) {
                if ($request->sisa[$i] <= 0) {
                    // dd($request);
                    return redirect('/sending')->with('alert', 'Stok Habis!');;
                } else {
                    $sending = new Sending();
                    $sending->kode_pengiriman = $request->kode_sending[$i];
                    $sending->kode_barang = $request->kode_barang[$i];
                    $sending->jumlah_barang = $request->jumlah_dibeli[$i];
                    // dd($sending);
                    $sending->save();
                }

                $sendingFind = $sending->kode_barang;
                $barang = Barang::where('kode_barang', $sendingFind)->first();
                $jumlahSend = ((float)($barang->stok_barang)) - ((float)($sending->jumlah_barang));
                $barang->stok_barang = $jumlahSend;
                //dd($barang);
                $barang->save();
            }

            $transaksi = new TransaksiKirim();
            $transaksi->kode_pengiriman = $request->kode_send;
            $transaksi->tanggal_transaksi = $request->tanggal;
            $transaksi->nama_pelanggan = $request->nama_pel;
            $transaksi->alamat_pelanggan = $request->alamat_pel;
            $transaksi->no_telp = $request->no_telp;
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
