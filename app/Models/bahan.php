<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\dashboard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class bahan extends Model
{
    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'warna',
        'stok_tersedia',
    ];
    
}


