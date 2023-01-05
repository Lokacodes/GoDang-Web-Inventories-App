<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //View Kategori
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.kategori', ['kategori' => $kategori]);
    }

    //Add Kategori
    public function store(Request $request)
    {
        //Message Alert (X)
        $message = ['kode_kategori.unique' => 'Kode Kategori Sudah Ada', 'nama_kategori.required' => 'Nama Kategori Tidak Boleh Kosong'];
        //Validasi
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_kategori' => 'unique:kategoris', 'nama_kategori' => 'required'], $message);
            //Gagal
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            } 
            //Berhasil
            else {
                $kategori = new Kategori;
                $kategori->kode_kategori = $request->kode_kategori;
                $kategori->nama_kategori = $request->nama_kategori;
                $kategori->save();

                //View Alert
                return response()->json(['success' => true, 'message' => 'Kategori Baru Telah Ditambahkan'], 200);
            }
        }
    }
}
