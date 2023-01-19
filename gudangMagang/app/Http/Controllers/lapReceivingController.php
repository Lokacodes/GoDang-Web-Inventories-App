<?php

namespace App\Http\Controllers;

use App\Models\Receiving;
use App\Models\TransaksiTerima;
use Illuminate\Http\Request;

class lapReceivingController extends Controller
{
    public function index()
    {
        $transaksiTerima = new TransaksiTerima();
        $receivings = $transaksiTerima->paginate(5);
        
        
        return view('Laporan.laporan_receiving', ['receivings' => $receivings]);
    }

    public function detail(){
        $receive = new Receiving();
        $receivings = $receive
        ->join('barangs', 'receivings.kode_barang' ,'=' ,'barangs.kode_barang')
        ->join('suppliers', 'receivings.kode_supplier' ,'=' ,'suppliers.kode_supplier')
        ->paginate(5);

        return view('Laporan.laporan_receiving_detail', ['receivings' => $receivings,'receive' => $receive]);
    }

    
}
