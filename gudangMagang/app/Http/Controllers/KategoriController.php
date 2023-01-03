<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.kategori', ['kategori' => $kategori]);
    }

    public function store(Request $request)
    {
        //
        $message = ['kode_kategori.unique' => 'Kode Kategori Sudah Ada', 'nama_kategori.required' => 'Nama Kategori Tidak Boleh Kosong'];
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_kategori' => 'unique:kategoris', 'nama_kategori' => 'required'], $message);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            } else {
                $kategori = new Kategori;
                $kategori->kode_kategori = $request->kode_kategori;
                $kategori->nama_kategori = $request->nama_kategori;
                $kategori->save();

                return response()->json(['success' => true, 'message' => 'success'], 200);
            }
        }
    }
}
