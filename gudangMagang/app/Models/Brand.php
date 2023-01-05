<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    //Yang Diisi
    protected $fillable = [
        'kode_brand',
        'nama_brand'
    ];
}
