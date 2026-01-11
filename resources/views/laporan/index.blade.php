<x-app-layout>
    <div class="bg-[#2A446C] min-h-screen pl-72 pt-40 pb-20">
        <div class="flex justify-start pl-[200px] text-3xl mb-8 text-white font-bold">
            Laporan
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- MENU UTAMA LAPORAN --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('laporan.produk') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Laporan Produk Jadi</h2>
                    <p class="text-gray-600">Laporan untuk produk masuk, keluar, dan retur.</p>
                </a>

                <a href="{{ route('laporan.bahan') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Laporan Bahan Baku</h2>
                    <p class="text-gray-600">Laporan untuk bahan masuk, keluar, dan retur.</p>
                </a>
            </div>

            {{-- FORM FILTER TAHUN --}}
<div class="flex justify-end mb-6">
    <form action="{{ route('laporan.index') }}" method="GET" class="flex items-center gap-2 bg-white p-2 rounded-lg shadow">
        <label for="tahun" class="text-sm font-bold text-gray-600 px-2">Pilih Tahun:</label>
        <select name="tahun" id="tahun" onchange="this.form.submit()" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @foreach($daftarTahun as $th)
                <option value="{{ $th }}" {{ $tahunDipilih == $th ? 'selected' : '' }}>{{ $th }}</option>
            @endforeach
            {{-- Jika database kosong, minimal tampilkan tahun sekarang --}}
            @if($daftarTahun->isEmpty())
                <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
            @endif
        </select>
    </form>
</div>

{{-- RINGKASAN STATISTIK ANGKA (Variabel tetap sama) --}}
...

            {{-- RINGKASAN STATISTIK ANGKA --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl shadow-md border-l-4 border-green-500">
                    <p class="text-xs text-gray-500 font-bold uppercase">Produk Masuk</p>
                    <p class="text-xl font-bold">{{ number_format($summary['p_masuk']) }} <span
                            class="text-sm font-normal text-gray-400">Unit</span></p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-md border-l-4 border-red-500">
                    <p class="text-xs text-gray-500 font-bold uppercase">Produk Keluar</p>
                    <p class="text-xl font-bold">{{ number_format($summary['p_keluar']) }} <span
                            class="text-sm font-normal text-gray-400">Unit</span></p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-md border-l-4 border-blue-500">
                    <p class="text-xs text-gray-500 font-bold uppercase">Bahan Masuk</p>
                    <p class="text-xl font-bold">{{ number_format($summary['b_masuk']) }} <span
                            class="text-sm font-normal text-gray-400">Unit</span></p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-md border-l-4 border-orange-500">
                    <p class="text-xs text-gray-500 font-bold uppercase">Bahan Keluar</p>
                    <p class="text-xl font-bold">{{ number_format($summary['b_keluar']) }} <span
                            class="text-sm font-normal text-gray-400">Unit</span></p>
                </div>
            </div>
            {{-- BAR CHART (Gaya Card Success) --}}
            <div class="card bg-white rounded-xl shadow-xl overflow-hidden border-t-4 border-green-500">
                {{-- Header Card --}}
                <div class="flex items-center justify-between px-6 py-3 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-green-600"></i>
                        Statistik Perbandingan Produk & Bahan
                    </h3>
                    <div class="flex gap-2 text-gray-400">
                        <button class="hover:text-gray-600"><i class="fas fa-minus"></i></button>
                        <button class="hover:text-red-500"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                {{-- Body Card --}}
                <div class="p-6">
                    <div class="relative" style="height: 350px;">
                        <canvas id="barChartCombined"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Script Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('barChartCombined').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels), // Mengambil nama bulan otomatis
                datasets: [
                    {
                        label: 'Produk Masuk',
                        backgroundColor: '#10B981',
                        data: @json($dataProdukMasuk),
                        borderRadius: 5
                    },
                    {
                        label: 'Produk Keluar',
                        backgroundColor: '#EF4444',
                        data: @json($dataProdukKeluar),
                        borderRadius: 5
                    },
                    {
                        label: 'Bahan Masuk',
                        backgroundColor: '#3B82F6',
                        data: @json($dataBahanMasuk),
                        borderRadius: 5
                    },
                    {
                        label: 'Bahan Keluar',
                        backgroundColor: '#F97316',
                        data: @json($dataBahanKeluar),
                        borderRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                // ... sisa options tetap sama ...
            }
        });
    });
</script>
</x-app-layout>
