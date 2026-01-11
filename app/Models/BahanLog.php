<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanLog extends Model
{
    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'jumlah',
        'tipe_transaksi',
        'supplier',
        'sisa_stok',
        'nama_pengambil',
        'tujuan',
        'keterangan',
        'status',
    ];
}
