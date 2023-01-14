<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sent extends Model
{
    protected $fillable = [
        'kode_pengiriman',
        'kode_barang',
        'jumlah_barang',
        'kode_ekspedisi'
    ];
    
    use HasFactory;
}
