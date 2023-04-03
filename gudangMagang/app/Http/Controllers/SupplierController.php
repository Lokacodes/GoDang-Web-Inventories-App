<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    //View Supplier
    public function index()
    {
        $supplier = DB::table('suppliers')->get();

        $autoId = DB::table('suppliers')->select(DB::raw('MAX(RIGHT(kode_supplier,2)) as autoId'));
        $kd = "";
        if ($autoId->count() > 0) {
            foreach ($autoId->get() as $a) {
                $tmp = ((int)$a->autoId) + 1;
                $kd = sprintf("%02s", $tmp);
            }
        } else {
            $kd = "01";
        }
        //Retrun Views
        return view('Suply.supplier', ['supplier' => $supplier, 'kd'=>$kd]);
    }

    //Add Supplier
    public function store(Request $request)
    {
        //Message Alert (X)
        $message = ['kode_supplier.unique' => 'Kode supplier Sudah Ada', 'nama_supplier.required' => 'Nama supplier Tidak Boleh Kosong', 'alamat.required' => 'Alamat supplier Tidak Boleh Kosong'];
        //Validasi
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_supplier' => 'unique:suppliers', 'nama_supplier' => 'required', 'alamat' => 'required'], $message);
            //Gagal
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
            //Berhasil
            else {
                $supplier = new Supplier();
                $supplier->kode_supplier = $request->kode_supplier;
                $supplier->nama_supplier = $request->nama_supplier;
                $supplier->alamat = $request->alamat;
                $supplier->save();

                //View Alert
                return response()->json(['success' => true, 'message' => 'Supplier Baru Telah Ditambahkan'], 200);
            }
        }
    }

    //Search Supplier
    public function search(Request $request)
    {
        //Variable
        $cari = $request->cari;

        //Request To Table
        $supplier = DB::table('suppliers')
            ->where('nama_supplier', 'like', "%" . $cari . "%");

        //Retrun Views
        return view('Suply.supplier', ['supplier' => $supplier]);
    }

    //Status Supplier
    public function status($status, $id)
    {
        $model = Supplier::findOrFail($id);
        $model->status = $status;

        //dd($model);
        if ($model->save()) {

            $notice = ['alert' => 'Status Telah Diganti'];
        }
        return redirect()->back()->with($notice);
    }
}
