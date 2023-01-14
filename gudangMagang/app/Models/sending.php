<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sending extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengiriman',
        'kode_barang',
        'jumlah_barang',
        'kode_ekspedisi'
    ];

    public function update_stok(){
        return $this->belongsTo(Barang::class,'barangs','kode_barang','kode_barang');
        // detil_pinjams=> tabel, kode_buku=>foreign_key ke buku , pinjam id=>foregin key ke pinjam id
    }
}
