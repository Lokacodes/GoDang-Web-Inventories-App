<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    //List Barang
    public function Index()
    {
        $barang = Barang::all();
        return view('Barang.list', ['barang'=>$barang]);
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


}
