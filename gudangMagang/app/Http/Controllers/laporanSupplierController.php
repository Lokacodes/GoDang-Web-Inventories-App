<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanSupplierController extends Controller
{
    public function index()
    {
        return view('Laporan.laporan_untuk_supplier');
    }

    public function search(Request $request)
    {
        $barang = Barang::select('nama_barang', 'kode_supplier', 'kode_barang');
        if ($request->kode_supplier) {
            $barangSupp = $barang->where('kode_supplier', '=', $request->kode_supplier)->get();
        } else {
            dd($request);
        }

        // dd($barangSupp);

        return view('Laporan.laporan_untuk_supplier', ['barang' => $barang, 'barangSupp' => $barangSupp]);
    }


    public function cariSupplier(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $cari = DB::table('suppliers')->orderBy('nama_supplier', 'asc')
                ->select('nama_supplier', 'kode_supplier', 'alamat')
                ->get();
        } else {
            $cari = DB::table('suppliers')->orderBy('nama_supplier', 'asc')
                ->select('nama_supplier', 'kode_supplier', 'alamat')
                ->where('nama_supplier', 'like', '%' . $search . '%')
                ->get();
        }

        $response = array();
        foreach ($cari as $suppli) {
            $response[] = array("value" => $suppli->nama_supplier, "kode" => $suppli->kode_supplier, "alamat" => $suppli->alamat);
        }

        return response()->json($response);
    }

    public function tampilBarang(Request $request)
    {
        $supplier = DB::table('sendings')
            // ->where('kode_supplier','=',$request->kode_supplier)
            // ->join('barangs','sendings.kode_barang','=','barangs.kode_barang')

            ->select('kode_barang', DB::raw('SUM(jumlah_barang) as total'))
            ->groupBy('kode_barang')

            // ->where('kode_supplier','=',$request->kode_supplier)
            // ->join('barangs','sendings.kode_barang','=','barangs.kode_barang')
            //->sum('jumlah_barang')
            ->get();

        //dd($supplier);

        return response()->json($supplier);
    }
}
