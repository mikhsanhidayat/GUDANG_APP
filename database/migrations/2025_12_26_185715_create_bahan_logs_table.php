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
        Schema::create('bahan_logs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bahan');
            $table->string('nama_bahan');
            $table->integer('jumlah');
            $table->enum('tipe_transaksi', ['masuk', 'keluar', 'retur']);
            $table->string('supplier')->nullable(); // untuk masuk
            $table->integer('sisa_stok')->nullable(); // untuk masuk
            $table->string('nama_pengambil')->nullable(); // untuk keluar
            $table->text('tujuan')->nullable(); // untuk keluar
            $table->text('keterangan')->nullable(); // untuk retur
            $table->string('status')->nullable(); // untuk retur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_logs');
    }
};
