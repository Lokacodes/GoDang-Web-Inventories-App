<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();
        return view('Brand.brand', ['brand' => $brand]);
    }

    public function store(Request $request)
    {
        //
        $message = ['kode_brand.unique' => 'Kode Brand Sudah Ada', 'nama_brand.required' => 'Nama Brand Tidak Boleh Kosong'];
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_brand' => 'unique:brands', 'nama_brand' => 'required'], $message);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            } else {
                $brand = new Brand;
                $brand->kode_brand = $request->kode_brand;
                $brand->nama_brand = $request->nama_brand;
                $brand->save();

                return response()->json(['success' => true, 'message' => 'success'], 200);
            }
        }
    }
}
