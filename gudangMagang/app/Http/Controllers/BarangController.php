<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

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

        //View File
        return view('Barang.list', ['barang' => $barang, 'kat' => $kategori, 'brand' => $brand]);
    }

    //Create Barang
    public function store(Request $request)
    {
        //Message Alert (X)
        $message = ['kode_barang.unique' => 'Kode Telah Tersedia', 'nama_barang.required' => 'Nama Barang Tidak Boleh Kosong'];
        
        //Validasi
        if ($request->ajax()) {
            $validator = Validator($request->all(), ['kode_barang' => 'unique:barangs', 'nama_barang' => 'required'], $message);
            //Gagal
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors($message)], 422);
            }
            //Berhasil 
            else {
                $barang = new Barang;
                $barang->kode_barang = $request->kode_barang;
                $barang->nama_barang = $request->nama_barang;
                $barang->kode_kategori = $request->kode_kategori;
                $barang->kode_brand = $request->kode_brand;
                $barang->harga_jual = $request->harga_jual;
                $barang->kode_supplier = $request->kode_supplier;
                $barang->save();

                //View Alert
                return response()->json(['success' => true, 'message' => 'Barang Baru Ditambahkan'], 200);
            }
        }
    }

    //Detail Barang
    public function show(Request $request)
    {
        //Select Table
        $barang = DB::table('barangs')->get();
        $kat = DB::table('kategoris')->get();

        //Show Detail Barang & Join Table
        $det = Barang::whereKodeBarang($request->kode_barang)
            ->join('kategoris', 'kategoris.kode_kategori', '=', 'barangs.kode_kategori')
            ->join('brands', 'brands.kode_brand', '=', 'barangs.kode_brand')
            ->join('suppliers', 'suppliers.kode_supplier', '=', 'barangs.kode_supplier')
            ->first();

        //View Views
        return view('Barang.detail', ['barang' => $barang, 'det' => $det, 'kat' => $kat]);
    }

    //Edit Form Barang
    public function form(Request $request)
    {
        //Select Table
        $barang = DB::table('barangs')->get();
        $kat = DB::table('kategoris')->get();
        $brand = DB::table('brands')->get();
        $supplier = DB::table('suppliers')->get();

        //Show Detail Barang & Join Table
        $det = Barang::whereKodeBarang($request->kode_barang)
            -> join('kategoris', 'kategoris.kode_kategori', '=', 'barangs.kode_kategori')
            -> join('brands', 'brands.kode_brand', '=', 'barangs.kode_brand')
            //-> join('suppliers', 'suppliers.kode_supplier', '=', 'barangs.kode_supplier')
            -> first();

        //Return View
        return view('Barang.edit', ['barang' => $barang, 'det' => $det, 'kat' => $kat, 'brand' => $brand, 'supplier' => $supplier]);
    }

    //Update Process
    public function update(Request $request)
    {
        //Variable
        $nama_barang = $request->nama_barang;
        $kode_kategori = $request->kode_kategori;
        $kode_brand = $request->kode_brand;
        $harga_beli = $request->harga_beli;
        $harga_jual = $request->harga_jual;
        $stok_barang = $request->stok_barang;
        $kode_supplier = $request->kode_supplier;

        //Validate Data
        $validate = $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kode_kategori' => 'required',
            'kode_brand' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok_barang' => 'required',
            'kode_supplier' => 'required'
            //'foto' => 'image|max:2048',
        ]);

        //File Store
        // if ($request->hasFile('foto')) {
        //     $path = $request->file('foto')->store('images');
        // }

        //Update Process
        $data = Barang::updateOrCreate(['kode_barang' => $request->kode_barang]);
        $data -> nama_barang = $nama_barang;
        $data -> kode_kategori = $kode_kategori;
        $data -> kode_brand = $kode_brand;
        $data -> harga_beli = $harga_beli;
        $data -> harga_jual = $harga_jual;
        $data -> stok_barang = $stok_barang;
        $data -> kode_supplier = $kode_supplier;
        // $data -> foto = $path;
        $data -> save();

        //Return View
        return redirect('/barang')->with('success', 'Data Telah Terupdate');
    }
}
