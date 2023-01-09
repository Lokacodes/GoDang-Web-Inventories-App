<?php

namespace App\Http\Controllers;

use App\Models\ekspedisi;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    public function index()
    {
        $ekspedisi = ekspedisi::all();
        return view('Ekspedisi.ekspedisi', ['ekspedisi' => $ekspedisi]);
    }

    //Add ekspedisi
    public function store(Request $request)
    {
        //Message Alert (X)
        $message = ['kode_ekspedisi.unique' => 'Kode ekspedisi Sudah Ada', 'nama_ekspedisi.required' => 'Nama ekspedisi Tidak Boleh Kosong', 'ongkir.required' => 'ongkir Tidak Boleh Kosong'];
        //Validasi
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_ekspedisi' => 'unique:ekspedisis', 'nama_ekspedisi' => 'required','ongkir' => 'required'], $message);
            //Gagal
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            } 
            //Berhasil
            else {
                $ekspedisi = new ekspedisi;
                $ekspedisi->kode_ekspedisi = $request->kode_ekspedisi;
                $ekspedisi->nama_ekspedisi = $request->nama_ekspedisi;
                $ekspedisi->ongkir = $request->ongkir;
                $ekspedisi->save();

                //View Alert
                return response()->json(['success' => true, 'message' => 'Ekspedisi Baru Telah Ditambahkan'], 200);
            }
        }
    }
}