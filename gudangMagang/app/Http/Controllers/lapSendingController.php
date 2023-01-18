<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class lapSendingController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('transaksi_kirims')->paginate(5);
        
        return view('Laporan.laporan_sending', ['transaksi' => $transaksi]);
    }

    public function detail(Request $request)
    {
        $transaksi = TransaksiKirim::whereKodePengiriman($request->kode_pengiriman)
        ->first(); 
        return view('Laporan.laporan_sending_detail', ['transaksi' => $transaksi]);
    }
}
