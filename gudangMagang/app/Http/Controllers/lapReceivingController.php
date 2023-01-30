<?php

namespace App\Http\Controllers;

use App\Models\Receiving;
use App\Models\TransaksiTerima;
use Illuminate\Http\Request;

class LapReceivingController extends Controller
{
    //View List Laporan
    public function index()
    {
        $transaksiTerima = new TransaksiTerima();
        $receivings = $transaksiTerima->paginate(5);

        return view('Laporan.laporan_receiving', ['receivings' => $receivings]);
    }

    //Detail Laporan
    public function detail(Request $request)
    {
        $receive = new Receiving();
        $receiveSupplier = $receive->where('kode_receive', '=', $request->kode_receive)->join('suppliers', 'receivings.kode_supplier', '=', 'suppliers.kode_supplier')->first();
        $receivings = $receive->where('kode_receive', '=', $request->kode_receive)
            ->join('barangs', 'receivings.kode_barang', '=', 'barangs.kode_barang')
            ->paginate(5);

        return view('Laporan.laporan_receiving_detail', ['receiveSupplier' => $receiveSupplier, 'receivings' => $receivings, 'receive' => $receive]);
    }
}
