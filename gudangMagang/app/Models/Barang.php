<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    //Yang Diisi
    protected $fillable = [
        'kode_barang',
        'kode_brand',
        'kode_kategori',
        'nama_barang',
        'stok_barang',
        'harga_jual',
        'kode_supplier',
        'status_barang',
        //'foto'
    ];

    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
}
