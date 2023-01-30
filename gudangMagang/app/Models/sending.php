<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sending extends Model
{
    use HasFactory;
    
    //Yang Diisi
    protected $fillable = [
        'kode_pengiriman',
        'kode_barang',
        'jumlah_barang',
    ];
}
