<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\BahanLog;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BahanController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $bahans = Bahan::paginate(10);
        return view('bahan.index', compact('bahans'));
    }

    public function create()
    {
        $this->authorize('create', Bahan::class);
        return view('bahan.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Bahan::class);

        $request->validate([
            'kode_bahan'     => 'required|string|unique:bahans,kode_bahan',
            'nama_bahan'     => 'required|string|max:255',
            'warna'          => 'required|string|max:50',
            'stok_tersedia'  => 'required|integer|min:0',
            'supplier'       => 'required|string|max:255',
        ]);

        Bahan::create([
            'kode_bahan'    => strtoupper($request->kode_bahan),
            'nama_bahan'    => $request->nama_bahan,
            'warna'         => $request->warna,
            'stok_tersedia' => $request->stok_tersedia,
        ]);

        // Simpan log untuk bahan baru
        BahanLog::create([
            'kode_bahan' => strtoupper($request->kode_bahan),
            'nama_bahan' => $request->nama_bahan,
            'jumlah' => $request->stok_tersedia,
            'tipe_transaksi' => 'masuk',
            'supplier' => $request->supplier,
        ]);

        return redirect()->route('bahan.index')->with('success', 'Bahan berhasil ditambahkan');
    }

    public function update(Request $request, Bahan $bahan)
{
    $this->authorize('update', $bahan);

    $request->validate([
        'nama_bahan'    => 'required|string|max:255',
        'warna'         => 'required|string|max:50',
        'stok_tersedia' => 'required|integer|min:0',
    ]);

    // LOGIKA UPDATE KODE OTOMATIS
    // Sesuaikan rumus substring ini dengan keinginan Anda (contoh: 3 huruf pertama nama + 1 huruf warna)
    $kodeNama = strtoupper(substr($request->nama_bahan, 0, 3));
    $kodeWarna = strtoupper(substr($request->warna, 0, 1));
    $kodeBaru = $kodeNama . '-' . $kodeWarna;

    // Validasi kode_bahan unik, kecuali untuk bahan ini sendiri
    $request->validate([
        'kode_bahan' => 'unique:bahans,kode_bahan,' . $bahan->id,
    ], [
        'kode_bahan.unique' => 'Kode bahan sudah ada, silakan ubah nama atau warna.',
    ]);

    $bahan->update([
        'kode_bahan'    => $kodeBaru, // Update kodenya di sini
        'nama_bahan'    => $request->nama_bahan,
        'warna'         => $request->warna,
        'stok_tersedia' => $request->stok_tersedia,
    ]);

    return redirect()->route('bahan.index')->with('success', 'Data & Kode Bahan berhasil diperbarui');
}

    public function destroy(Bahan $bahan)
    {
        $this->authorize('delete', $bahan);
        $bahan->delete();

        return redirect()->route('bahan.index');
    }

    public function tambahStok(Request $request, Bahan $bahan)
    {
        $this->authorize('tambah', $bahan);

        $request->validate([
            'stok_tambah' => 'required|integer|min:1',
            'supplier' => 'required|string|max:255',
        ]);

        $sisaStokSebelum = $bahan->stok_tersedia;
        $bahan->increment('stok_tersedia', $request->stok_tambah);

        // Simpan log
        BahanLog::create([
            'kode_bahan' => $bahan->kode_bahan,
            'nama_bahan' => $bahan->nama_bahan,
            'jumlah' => $request->stok_tambah,
            'tipe_transaksi' => 'masuk',
            'supplier' => $request->supplier,
            'sisa_stok' => $sisaStokSebelum + $request->stok_tambah,
        ]);

        return redirect()->route('bahan.index');
    }

    public function ambil(Request $request, Bahan $bahan)
    {
        $request->validate([
            'stok_ambil' => 'required|integer|min:1|max:' . $bahan->stok_tersedia,
            'nama_pengambil' => 'required|string|max:255',
            'tujuan' => 'required|string|max:500',
        ], [
            'stok_ambil.max' => 'Jumlah pengambilan melebihi stok yang tersedia!',
        ]);

        $bahan->decrement('stok_tersedia', $request->stok_ambil);

        // Simpan log
        BahanLog::create([
            'kode_bahan' => $bahan->kode_bahan,
            'nama_bahan' => $bahan->nama_bahan,
            'jumlah' => $request->stok_ambil,
            'tipe_transaksi' => 'keluar',
            'nama_pengambil' => $request->nama_pengambil,
            'tujuan' => $request->tujuan,
        ]);

        return redirect()->route('bahan.index');
    }

    public function retur(Request $request, Bahan $bahan)
    {
        $request->validate([
            'jumlah_retur' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Increment stok karena hanya kondisi baik
        $bahan->increment('stok_tersedia', $request->jumlah_retur);

        // Simpan log
        BahanLog::create([
            'kode_bahan' => $bahan->kode_bahan,
            'nama_bahan' => $bahan->nama_bahan,
            'jumlah' => $request->jumlah_retur,
            'tipe_transaksi' => 'retur',
            'keterangan' => $request->keterangan,
            'status' => 'Otomatis Kembali ke Stok',
        ]);

        return redirect()->route('bahan.index');
    }
}
