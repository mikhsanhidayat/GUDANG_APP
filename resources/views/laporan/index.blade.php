<x-app-layout>
    <div class="mt-3">
        <h4 class="text-xl font-bold text-navy-700 mb-5">Laporan / <span class="text-gray-500 font-medium">Ringkasan</span></h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
            <a href="{{ route('laporan.produk') }}" class="horizon-card w-full p-6 transition-transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="rounded-full bg-lightPrimary p-3 mr-4">
                        <i class="ti ti-box text-2xl text-brand-500"></i>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold text-navy-700">Laporan Produk Jadi</h5>
                        <p class="text-sm font-medium text-gray-500">Laporan untuk produk masuk, keluar, dan retur.</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('laporan.bahan') }}" class="horizon-card w-full p-6 transition-transform hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="rounded-full bg-lightPrimary p-3 mr-4">
                        <i class="ti ti-stack text-2xl text-brand-500"></i>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold text-navy-700">Laporan Bahan Baku</h5>
                        <p class="text-sm font-medium text-gray-500">Laporan untuk bahan masuk, keluar, dan retur.</p>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="horizon-card w-full p-6">
            <div class="flex flex-col sm:flex-row justify-between items-center border-b border-gray-100 pb-4 mb-6 gap-4">
                <h5 class="text-xl font-bold text-navy-700">Ringkasan Statistik {{ $tahunDipilih }}</h5>
                <form action="{{ route('laporan.index') }}" method="GET" class="flex items-center gap-3">
                    <label for="tahun" class="text-sm font-bold text-navy-700 whitespace-nowrap">Pilih Tahun:</label>
                    <div class="relative">
                        <select name="tahun" id="tahun" onchange="this.form.submit()" class="block w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-2 pr-8 text-sm font-medium text-navy-700 outline-none focus:border-brand-500 focus:ring-0">
                            @foreach($daftarTahun as $th)
                                <option value="{{ $th }}" {{ $tahunDipilih == $th ? 'selected' : '' }}>{{ $th }}</option>
                            @endforeach
                            @if($daftarTahun->isEmpty())
                                <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                            @endif
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <i class="ti ti-chevron-down"></i>
                        </div>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <!-- P Masuk -->
                <div class="rounded-[20px] border border-horizonGreen-500/20 bg-green-50/30 p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-600 mb-1">Produk Masuk</p>
                    <div class="flex items-end gap-2">
                        <h4 class="text-2xl font-bold text-navy-700">{{ number_format($summary['p_masuk']) }}</h4>
                        <span class="text-sm font-bold text-horizonGreen-500 mb-1">Unit</span>
                    </div>
                </div>
                <!-- P Keluar -->
                <div class="rounded-[20px] border border-horizonRed-500/20 bg-red-50/30 p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-600 mb-1">Produk Keluar</p>
                    <div class="flex items-end gap-2">
                        <h4 class="text-2xl font-bold text-navy-700">{{ number_format($summary['p_keluar']) }}</h4>
                        <span class="text-sm font-bold text-horizonRed-500 mb-1">Unit</span>
                    </div>
                </div>
                <!-- B Masuk -->
                <div class="rounded-[20px] border border-blue-500/20 bg-blue-50/30 p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-600 mb-1">Bahan Masuk</p>
                    <div class="flex items-end gap-2">
                        <h4 class="text-2xl font-bold text-navy-700">{{ number_format($summary['b_masuk']) }}</h4>
                        <span class="text-sm font-bold text-blue-500 mb-1">Unit</span>
                    </div>
                </div>
                <!-- B Keluar -->
                <div class="rounded-[20px] border border-horizonOrange-500/20 bg-orange-50/30 p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-600 mb-1">Bahan Keluar</p>
                    <div class="flex items-end gap-2">
                        <h4 class="text-2xl font-bold text-navy-700">{{ number_format($summary['b_keluar']) }}</h4>
                        <span class="text-sm font-bold text-horizonOrange-500 mb-1">Unit</span>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <h5 class="text-lg font-bold text-navy-700 mb-4 flex items-center gap-2">
                    <i class="ti ti-chart-bar text-brand-500"></i> Statistik Perbandingan Produk & Bahan
                </h5>
                <div style="height: 350px;">
                    <canvas id="barChartCombined"></canvas>
                </div>
            </div>
        </div>
    </div>

    @push('page-js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('barChartCombined').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [
                        {
                            label: 'Produk Masuk',
                            backgroundColor: '#01B574', // horizonGreen-500
                            data: @json($dataProdukMasuk),
                            borderRadius: 4
                        },
                        {
                            label: 'Produk Keluar',
                            backgroundColor: '#E31A1A', // horizonRed-500
                            data: @json($dataProdukKeluar),
                            borderRadius: 4
                        },
                        {
                            label: 'Bahan Masuk',
                            backgroundColor: '#3b82f6', // blue-500
                            data: @json($dataBahanMasuk),
                            borderRadius: 4
                        },
                        {
                            label: 'Bahan Keluar',
                            backgroundColor: '#FFB547', // horizonOrange-500
                            data: @json($dataBahanKeluar),
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
