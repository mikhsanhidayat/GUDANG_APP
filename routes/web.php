<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
    Route::put('/products/{product}/tambah-stok', [ProductController::class, 'tambahStok'])->name('products.tambah-stok');
    Route::put('/products/{product}/ambil-stok', [ProductController::class, 'ambil'])->name('products.ambil-stok');
    Route::put('/products/{product}/retur', [ProductController::class, 'retur'])->name('products.retur');

   Route::resource('bahan', BahanController::class);

// STOK
Route::put('/bahan/{bahan}/tambah-stok', [BahanController::class, 'tambahStok'])
    ->name('bahan.tambahStok');

Route::put('/bahan/{bahan}/ambil-stok', [BahanController::class, 'ambil'])
    ->name('bahan.ambil');

Route::put('/bahan/{bahan}/retur', [BahanController::class, 'retur'])
    ->name('bahan.retur');



    
    // Gunakan jamak 'users' agar lebih standar Laravel
Route::resource('users', UserController::class);

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/produk', [LaporanController::class, 'produk'])->name('laporan.produk');
    Route::get('/laporan/bahan', [LaporanController::class, 'bahan'])->name('laporan.bahan');
    
   
});




require __DIR__ . '/auth.php';
