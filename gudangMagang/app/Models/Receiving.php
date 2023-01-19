<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use HasFactory;

    //Yang Diisi
    protected $fillable = [
        'kode_receive',
        'kode_barang',
        'kode_supplier',
        'jumlah_barang'
    ];

    //Relasi
    public function receive()
    {
        return $this -> belongsTo(Barang::class, 'kode_barang');
    }
}
