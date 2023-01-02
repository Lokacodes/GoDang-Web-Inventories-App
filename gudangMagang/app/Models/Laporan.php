<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_laporan',
        'kode_ekspedisi',
        'kode_barang',
        'jumlah_terjual',
        'harga_jual',
        'keuntungan',
    ];
}
