<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Dashboard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Bahan extends Model
{
    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'warna',
        'stok_tersedia',
    ];
    
}


