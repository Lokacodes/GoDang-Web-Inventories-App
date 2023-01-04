<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;

class BarangController extends Controller
{
    //List Barang 
    public function Index()
    {
        //Show Join In Form
        $kategori = DB::table('kategoris')->get();
        $brand = DB::table('brands')->get();

        //Join
        $barang = Barang::join('kategoris', 'kategoris.kode_kategori', '=', 'barangs.kode_kategori')
                        ->join('brands', 'brands.kode_brand', '=', 'barangs.kode_brand')
                        ->get();
        return view('Barang.list', ['barang'=>$barang, 'kat'=>$kategori, 'brand'=>$brand]);
    }

    //Create Barang
    public function store(Request $request)
    {
        $message = ['kode_barang.unique' => 'Kode Telah Tersedia', 'nama_barang.required' => 'Nama Barang Tidak Boleh Kosong'];
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_barang' => 'unique:barangs', 'nama_barang' => 'required'], $message);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            } else {
                $barang = new Barang;
                $barang->kode_barang = $request->kode_barang;
                $barang->nama_barang = $request->nama_barang;
                $barang->kode_kategori = $request->kode_kategori;
                $barang->kode_brand = $request->kode_brand;
                $barang->harga_jual = $request->harga_jual;
                $barang->save();

                return response()->json(['success' => true, 'message' => 'Barang Baru Ditambahkan'], 200);
            }
        }
    }

    public function show(Request $request)
    {
        $barang = DB::table('barangs')->get();

        // $kat = DB::table('alats')
        //     ->join('kategoris', 'kategoris.id_kategori', '=', 'alats.id_kategori')
        //     ->get();
        // $kat = Kategori::whereIdKategori($request->id_kategori)->firstOrFail();
        $kat = DB::table('kategoris')->get();
        $det = Barang::join('kategoris', 'kategoris.kode_kategori', '=', 'barangs.kode_kategori')
                ->join('brands', 'brands.kode_brand', '=', 'barangs.kode_brand')
                ->get();
        $det = Barang::whereKodeBarang($request->kode_barang)->firstOrFail();
        return view('Barang.detail', ['barang' => $barang, 'det' => $det, 'kat' => $kat]);
    }
}
