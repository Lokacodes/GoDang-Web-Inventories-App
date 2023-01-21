<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTerima extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_receive',
        'tanggal_receive',
        'kode_supplier'
    ];
}