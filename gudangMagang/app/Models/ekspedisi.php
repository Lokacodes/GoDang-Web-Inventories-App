<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekspedisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_ekspedisi',
        'nama_ekspedisi',
        'ongkir',
    ];
}