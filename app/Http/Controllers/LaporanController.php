<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductLog;
use App\Models\BahanLog;
use Carbon\Carbon;

class LaporanController extends Controller
{
   public function index(Request $request)
{
    // 1. Ambil tahun dari filter, default ke tahun sekarang
    $tahunDipilih = $request->get('tahun', date('Y'));

    $labels = [];
    $dataProdukMasuk = [];
    $dataProdukKeluar = [];
    $dataBahanMasuk = [];
    $dataBahanKeluar = [];

    // 2. Loop 12 bulan untuk tahun yang dipilih
    for ($m = 1; $m <= 12; $m++) {
        $month = \Carbon\Carbon::create($tahunDipilih, $m, 1);
        $labels[] = $month->translatedFormat('F Y');

        // Query berdasarkan bulan dan tahun yang dipilih
        $dataProdukMasuk[] = \App\Models\ProductLog::whereMonth('created_at', $m)
            ->whereYear('created_at', $tahunDipilih)
            ->where('tipe_transaksi', 'masuk')
            ->sum('jumlah');

        $dataProdukKeluar[] = \App\Models\ProductLog::whereMonth('created_at', $m)
            ->whereYear('created_at', $tahunDipilih)
            ->where('tipe_transaksi', 'keluar')
            ->sum('jumlah');

        $dataBahanMasuk[] = \App\Models\BahanLog::whereMonth('created_at', $m)
            ->whereYear('created_at', $tahunDipilih)
            ->where('tipe_transaksi', 'masuk')
            ->sum('jumlah');

        $dataBahanKeluar[] = \App\Models\BahanLog::whereMonth('created_at', $m)
            ->whereYear('created_at', $tahunDipilih)
            ->where('tipe_transaksi', 'keluar')
            ->sum('jumlah');
    }

    // 3. Ringkasan tetap dihitung berdasarkan tahun yang dipilih
    $summary = [
        'p_masuk'  => \App\Models\ProductLog::whereYear('created_at', $tahunDipilih)->where('tipe_transaksi', 'masuk')->sum('jumlah'),
        'p_keluar' => \App\Models\ProductLog::whereYear('created_at', $tahunDipilih)->where('tipe_transaksi', 'keluar')->sum('jumlah'),
        'b_masuk'  => \App\Models\BahanLog::whereYear('created_at', $tahunDipilih)->where('tipe_transaksi', 'masuk')->sum('jumlah'),
        'b_keluar' => \App\Models\BahanLog::whereYear('created_at', $tahunDipilih)->where('tipe_transaksi', 'keluar')->sum('jumlah'),
    ];

    // Ambil daftar tahun unik dari data log untuk isi dropdown filter
    $daftarTahun = \App\Models\ProductLog::selectRaw('YEAR(created_at) as tahun')
        ->union(\App\Models\BahanLog::selectRaw('YEAR(created_at) as tahun'))
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    return view('laporan.index', compact(
        'labels', 'dataProdukMasuk', 'dataProdukKeluar', 
        'dataBahanMasuk', 'dataBahanKeluar', 'summary', 
        'tahunDipilih', 'daftarTahun'
    ));
}

    public function produk(Request $request)
    {
        $filter = $request->get('filter', 'minggu');
        $startDate = null;
        $endDate = null;

        if ($filter == 'minggu') {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
        } elseif ($filter == 'bulan') {
            $bulan = $request->get('bulan', date('m'));
            $tahun = $request->get('tahun', date('Y'));
            $startDate = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $endDate = Carbon::create($tahun, $bulan, 1)->endOfMonth();
        } elseif ($filter == 'tahun') {
            $tahun = $request->get('tahun', date('Y'));
            $startDate = Carbon::create($tahun, 1, 1)->startOfYear();
            $endDate = Carbon::create($tahun, 12, 31)->endOfYear();
        }

        $logs = ProductLog::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('laporan.produk', compact('logs', 'filter', 'startDate', 'endDate'));
    }

    public function bahan(Request $request)
    {
        $filter = $request->get('filter', 'minggu');
        $startDate = null;
        $endDate = null;

        if ($filter == 'minggu') {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
        } elseif ($filter == 'bulan') {
            $bulan = $request->get('bulan', date('m'));
            $tahun = $request->get('tahun', date('Y'));
            $startDate = Carbon::create($tahun, $bulan, 1)->startOfMonth();
            $endDate = Carbon::create($tahun, $bulan, 1)->endOfMonth();
        } elseif ($filter == 'tahun') {
            $tahun = $request->get('tahun', date('Y'));
            $startDate = Carbon::create($tahun, 1, 1)->startOfYear();
            $endDate = Carbon::create($tahun, 12, 31)->endOfYear();
        }

        $logs = BahanLog::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('laporan.bahan', compact('logs', 'filter', 'startDate', 'endDate'));
    }
}
