<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ProductController extends Controller
{

    use authorizesRequests;

    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));

       
        
    }

    public function create()
    { 
        $this->authorize('create', Product::class);
        return view('products.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'warna' => 'required|string|max:50',
            'logo' => 'required|in:IBI,IDI',
            'stok_tersedia' => 'required|integer|min:0',
        ]);

        $kodeProduk = $this->generateKodeProduk(
            $request->nama_produk,
            $request->warna,
            $request->logo
        );

        if (Product::where('kode_produk', $kodeProduk)->exists()) {
            return back()->withErrors([
                'kode_produk' => 'Produk ini sudah ada.'
            ])->withInput();
        }

        Product::create([
            'kode_produk' => $kodeProduk,
            'nama_produk' => $request->nama_produk,
            'warna' => $request->warna,
            'logo' => $request->logo,
            'stok_tersedia' => $request->stok_tersedia,
        ]);

        // Simpan log untuk produk baru
        ProductLog::create([
            'kode_produk' => $kodeProduk,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->stok_tersedia,
            'tipe_transaksi' => 'masuk',
            'petugas' => 'Admin', // atau bisa kosong
        ]);

        return redirect()->route('products.index');
    }

    public function update(Request $request, Product $product)
    {
        
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'warna' => 'required|string|max:50',
            'logo' => 'required|in:IBI,IDI',
            'stok_tersedia' => 'required|integer|min:0',
        ]);

        $kodeProduk = $this->generateKodeProduk(
            $request->nama_produk,
            $request->warna,
            $request->logo
        );

        $exists = Product::where('kode_produk', $kodeProduk)
            ->where('id', '!=', $product->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'kode_produk' => 'Produk ini sudah ada.'
            ]);
        }

        $product->update([
            'kode_produk' => $kodeProduk,
            'nama_produk' => $request->nama_produk,
            'warna' => $request->warna,
            'logo' => $request->logo,
            'stok_tersedia' => $request->stok_tersedia,
        ]);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        
        $product->delete();
        return redirect()->route('products.index');
    }

    public function tambahStok(Request $request, Product $product)
    {
       
        $request->validate([
            'stok_tambah' => 'required|integer|min:1',
            'petugas' => 'required|string|max:255',
        ]);

        $product->increment('stok_tersedia', $request->stok_tambah);

        // Simpan log
        ProductLog::create([
            'kode_produk' => $product->kode_produk,
            'nama_produk' => $product->nama_produk,
            'jumlah' => $request->stok_tambah,
            'tipe_transaksi' => 'masuk',
            'petugas' => $request->petugas,
        ]);

        return redirect()->route('products.index');
    }

    // ✅ AMBIL STOK (FINAL & AMAN)
    public function ambil(Request $request, Product $product)
    {
        $request->validate([
            'stok_ambil' => 'required|integer|min:1|max:' . $product->stok_tersedia,
            'penerima' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $product->decrement('stok_tersedia', $request->stok_ambil);

        // Simpan log
        ProductLog::create([
            'kode_produk' => $product->kode_produk,
            'nama_produk' => $product->nama_produk,
            'jumlah' => $request->stok_ambil,
            'tipe_transaksi' => 'keluar',
            'penerima' => $request->penerima,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('products.index');
    }

    // RETUR PRODUK
    public function retur(Request $request, Product $product)
    {
        $request->validate([
            'jumlah_retur' => 'required|integer|min:1',
            'kondisi' => 'required|in:rusak,bagus',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Jika kondisi bagus, increment stok
        if ($request->kondisi == 'bagus') {
            $product->increment('stok_tersedia', $request->jumlah_retur);
        }

        // Simpan log
        ProductLog::create([
            'kode_produk' => $product->kode_produk,
            'nama_produk' => $product->nama_produk,
            'jumlah' => $request->jumlah_retur,
            'tipe_transaksi' => 'retur',
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('products.index');
    }

    private function generateKodeProduk($namaProduk, $warna, $logo)
    {
        return strtoupper(
            substr($namaProduk, 0, 1) .
            substr($namaProduk, 2, 1) .
            substr($namaProduk, 3, 1) .
            substr($namaProduk, -1) .
            '-' . substr($warna, 0, 1) .
            '-' . ($logo === 'IBI' ? '01' : '02')
        );
    }
}