<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'jumlah',
        'tipe_transaksi',
        'kondisi',
        'petugas',
        'penerima',
        'keterangan',
    ];
}
