<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    public function index()
    {
        $ekspedisi = Ekspedisi::all();
        return view('Ekspedisi.ekspedisi', ['ekspedisi' => $ekspedisi]);
    }

    //Add ekspedisi
    public function store(Request $request)
    {
        //Message Alert (X)
        $message = ['kode_ekspedisi.unique' => 'Kode ekspedisi Sudah Ada', 'nama_ekspedisi.required' => 'Nama ekspedisi Tidak Boleh Kosong'];
        //Validasi
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_ekspedisi' => 'unique:ekspedisis', 'nama_ekspedisi' => 'required'], $message);
            //Gagal
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
            //Berhasil
            else {
                $ekspedisi = new Ekspedisi;
                $ekspedisi->kode_ekspedisi = $request->kode_ekspedisi;
                $ekspedisi->nama_ekspedisi = $request->nama_ekspedisi;
                $ekspedisi->save();

                //View Alert
                return response()->json(['success' => true, 'message' => 'Ekspedisi Baru Telah Ditambahkan'], 200);
            }
        }
    }

    //Status
    public function status($status, $kode_ekspedisi)
    {
        $model = Ekspedisi::findOrFail($kode_ekspedisi);
        $model->status = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }
        return redirect()->back()->with($notice);
    }
}
