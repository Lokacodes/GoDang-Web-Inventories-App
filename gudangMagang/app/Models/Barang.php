<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'kode_brand',
        'kode_kategori',
        'nama_barang',
        'stok_barang',
        'harga_beli',
        'harga_jual'
    ];
}
