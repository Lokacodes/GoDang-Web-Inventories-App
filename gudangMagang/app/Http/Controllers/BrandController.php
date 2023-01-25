<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //View Brand
    public function index()
    {
        //Select Table Brand
        $brand = Brand::select('*')
        ->paginate(5);

        //Return View File
        return view('Brand.brand', ['brand' => $brand]);
    }

    //Add Brand
    public function store(Request $request)
    {
        //Mesagge Error (X)
        $message = ['kode_brand.unique' => 'Kode Brand Sudah Ada', 'nama_brand.required' => 'Nama Brand Tidak Boleh Kosong'];
        //Validasi
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_brand' => 'unique:brands', 'nama_brand' => 'required'], $message);
            //Gagal
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
            //Berhasil 
            else {
                $brand = new Brand;
                $brand->kode_brand = $request->kode_brand;
                $brand->nama_brand = $request->nama_brand;
                $brand->save();

                //View Alert
                return response()->json(['success' => true, 'message' => 'Brand Baru Telah Ditambahkan'], 200);
            }
        }
    }

    //Status
    public function status($status, $kode_brand)
    {
        $model = Brand::findOrFail($kode_brand);
        $model->status = $status;

        dd($model);
        // if ($model->save()) {

        //     $notice = ['alert' => 'Status Telah Diganti'];
        // }
        // return redirect()->back()->with($notice);
    }
}
