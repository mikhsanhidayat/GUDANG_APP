<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_logs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->integer('jumlah');
            $table->enum('tipe_transaksi', ['masuk', 'keluar', 'retur']);
            $table->enum('kondisi', ['rusak', 'bagus'])->nullable();
            $table->string('petugas')->nullable(); // untuk masuk
            $table->string('penerima')->nullable(); // untuk keluar
            $table->text('keterangan')->nullable(); // untuk keluar/retur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_logs');
    }
};
