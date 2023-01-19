<?php

namespace App\Http\Controllers;

use App\Models\Sending;
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
        ->join('ekspedisis', 'transaksi_kirims.kode_ekspedisi' ,'=', 'ekspedisis.kode_ekspedisi' )
        ->first(); 
        $sending = Sending::whereKodePengiriman($request->kode_pengiriman)
        ->join('barangs', 'sendings.kode_barang' ,'=', 'barangs.kode_barang')
        ->get();
        return view('Laporan.laporan_sending_detail', ['transaksi' => $transaksi, 'sending'=>$sending]);
    }
}
