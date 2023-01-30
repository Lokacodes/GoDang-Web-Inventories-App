<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Receiving;
use App\Models\TransaksiTerima;

class ReceivingController extends Controller
{
    //View Receiving
    public function index()
    {
        //Select Table
        $receive = DB::table('suppliers')->get();

        $autoId = DB::table('receivings')->select(DB::raw('MAX(RIGHT(kode_receive,4)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        //Return Views
        return view('Receive.receive', compact('receive', 'kd'));
    }

    //Search Supplier
    public function searchsupply(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $cari = DB::table('suppliers')->orderBy('nama_supplier', 'asc')
                ->select('nama_supplier', 'kode_supplier', 'alamat', 'status')
                ->where('status', '=', '1')
                ->get();
        } else {
            $cari = DB::table('suppliers')->orderBy('nama_supplier', 'asc')
                ->select('nama_supplier', 'kode_supplier', 'alamat', 'status')
                ->where('status', '=', '1')
                ->where('nama_supplier', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $suppli) {
            $response[] = array("value" => $suppli->nama_supplier, "kode" => $suppli->kode_supplier, "alamat" => $suppli->alamat);
        }

        return response()->json($response);
    }

    //Search Barang
    public function barang(Request $request)
    {
        $search = $request->search;
        $supplier = $request->supplier;

        if ($search == '') {
            $barang = Barang::orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_barang', 'stok_barang', 'harga_jual', 'harga_beli', 'kode_supplier', 'status_barang')
                ->where('status_barang', '=', '1')
                ->where('kode_supplier', '=', $supplier)
                ->get();
        } else {
            $barang = Barang::orderBy('nama_barang', 'asc')
                ->select('kode_barang', 'nama_barang', 'stok_barang', 'harga_jual', 'harga_beli', 'kode_supplier', 'status_barang')
                ->where('status_barang', '=', '1')
                ->where('kode_supplier', '=', $supplier)
                ->where('nama_barang', 'like', '%' . $search . '%')
                ->get();
        }


        $response = array();
        foreach ($barang as $barang) {
            $response[] = array("value" => $barang->nama_barang, "label1" => $barang->kode_barang, "label2" => $barang->stok_barang, "label3" => $barang->kode_supplier, "label4" => $barang->harga_jual);
        }
        // dd($supplier);
        return response()->json($response);
    }

    //Save Receiving
    public function receivingStore(Request $request)
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
                $receive = new Receiving();
                $receive->kode_receive = $request->kode_receiving[$i];
                $receive->kode_barang = $request->kode_barang[$i];
                $receive->kode_supplier = $request->kode_supplier[$i];
                $receive->jumlah_barang = $request->jumlah[$i];
                //dd($request);
                $receive->save();

                $sendingFind = $receive->kode_barang;
                $barang = Barang::where('kode_barang', $sendingFind)->first();
                $jumlahReceive = ((float)($barang->stok_barang)) + ((float)($receive->jumlah_barang));
                $barang->stok_barang = $jumlahReceive;
                //dd($barang);
                $barang->save();
            }

            $transaksiTerima = new TransaksiTerima();
            $transaksiTerima->kode_receive = $request->receives;
            $transaksiTerima->tanggal_receive = $request->tanggal;
            $transaksiTerima->save();

            return redirect('/receiving')->with('alert', 'Data Penerimaan Barang Telah Disimpan');
        }
    }
}
