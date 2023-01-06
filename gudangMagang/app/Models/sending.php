<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sending extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pengiriman',
        'kode_barang',
        'jumlah_barang',
        'fee_ekspedisi',
    ];
}
