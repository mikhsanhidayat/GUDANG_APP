<x-app-layout>
    <div class="mt-3">
        <h4 class="text-xl font-bold text-navy-700 mb-5">Laporan / <span class="text-gray-500 font-medium">Bahan Baku</span></h4>

        <div class="horizon-card w-full p-6 mb-5">
            <form method="GET" action="{{ route('laporan.bahan') }}" class="flex flex-col md:flex-row items-end gap-4">
                <div class="w-full md:w-auto">
                    <label class="mb-2 block text-sm font-bold text-navy-700" for="filter">Filter</label>
                    <div class="relative">
                        <select name="filter" id="filter" class="block w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-2.5 pr-8 text-sm font-medium text-navy-700 outline-none focus:border-brand-500 focus:ring-0">
                            <option value="minggu" {{ $filter == 'minggu' ? 'selected' : '' }}>Per Minggu</option>
                            <option value="bulan" {{ $filter == 'bulan' ? 'selected' : '' }}>Per Bulan</option>
                            <option value="tahun" {{ $filter == 'tahun' ? 'selected' : '' }}>Per Tahun</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500"><i class="ti ti-chevron-down"></i></div>
                    </div>
                </div>

                <div id="bulan-container" class="w-full md:w-auto {{ $filter != 'bulan' ? 'hidden' : '' }}">
                    <label class="mb-2 block text-sm font-bold text-navy-700">Bulan</label>
                    <div class="relative">
                        <select name="bulan" class="block w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-2.5 pr-8 text-sm font-medium text-navy-700 outline-none focus:border-brand-500 focus:ring-0">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan', Carbon\Carbon::now()->month) == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500"><i class="ti ti-chevron-down"></i></div>
                    </div>
                </div>

                <div id="tahun-container" class="w-full md:w-auto {{ $filter == 'minggu' ? 'hidden' : '' }}">
                    <label class="mb-2 block text-sm font-bold text-navy-700">Tahun</label>
                    <div class="relative">
                        <select name="tahun" class="block w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-2.5 pr-8 text-sm font-medium text-navy-700 outline-none focus:border-brand-500 focus:ring-0">
                            @for ($year = 2020; $year <= 2030; $year++)
                                <option value="{{ $year }}" {{ request('tahun', Carbon\Carbon::now()->year) == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500"><i class="ti ti-chevron-down"></i></div>
                    </div>
                </div>

                <button type="submit" class="rounded-xl bg-brand-500 px-6 py-2.5 text-sm font-medium text-white transition hover:bg-brand-600 shadow-md shadow-brand-500/30 w-full md:w-auto">
                    Terapkan Filter
                </button>
            </form>
        </div>

        <div class="mb-5">
            <div class="flex h-10 items-center rounded-full bg-white text-navy-700 w-full md:w-[350px] shadow-sm">
                <p class="pl-4 pr-2 text-xl">
                    <i class="ti ti-search h-4 w-4 text-gray-400"></i>
                </p>
                <input type="text" id="searchLaporan" placeholder="Cari di semua laporan bahan..." class="block h-full w-full rounded-full bg-transparent text-sm font-medium text-navy-700 outline-none placeholder:!text-gray-400 border-none focus:ring-0" />
            </div>
        </div>

        {{-- LAPORAN BAHAN MASUK --}}
        <div class="horizon-card w-full p-4 overflow-hidden mb-6 section-laporan" id="section-masuk">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                <h5 class="text-lg font-bold text-navy-700">Laporan Bahan Masuk</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-laporan">
                    <thead>
                        <tr class="border-b border-gray-200 text-left text-sm font-bold tracking-wide text-gray-600 uppercase">
                            <th class="pb-3 px-4 text-center">No</th>
                            <th class="pb-3 px-4 text-center">Tanggal</th>
                            <th class="pb-3 px-4 text-center">Kode Bahan</th>
                            <th class="pb-3 px-4 text-center">Nama Bahan</th>
                            <th class="pb-3 px-4 text-center">Supplier</th>
                            <th class="pb-3 px-4 text-center">Jumlah Tambah</th>
                            <th class="pb-3 px-4 text-center">Sisa Stok Saat Itu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs->where('tipe_transaksi', 'masuk') as $log)
                            <tr class="row-data border-b border-gray-50 hover:bg-gray-50 transition-colors" data-jumlah="{{ $log->jumlah }}">
                                <td class="py-3 px-4 text-center text-sm text-navy-700 row-number">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-center text-sm font-medium text-navy-700">{{ $log->created_at->format('Y-m-d') }}</td>
                                <td class="py-3 px-4 text-center text-sm font-bold text-navy-700">{{ $log->kode_bahan }}</td>
                                <td class="py-3 px-4 text-center text-sm font-medium text-navy-700">{{ $log->nama_bahan }}</td>
                                <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $log->supplier ?? 'N/A' }}</td>
                                <td class="py-3 px-4 text-center text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-horizonGreen-500">
                                        {{ $log->jumlah }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $log->sisa_stok ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr class="no-data">
                                <td colspan="7" class="py-6 text-center text-sm text-gray-500 italic">Tidak ada data tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- LAPORAN PENGAMBILAN BAHAN --}}
        <div class="horizon-card w-full p-4 overflow-hidden mb-6 section-laporan" id="section-keluar">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                <h5 class="text-lg font-bold text-navy-700">Laporan Pengambilan Bahan (Keluar)</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-laporan">
                    <thead>
                        <tr class="border-b border-gray-200 text-left text-sm font-bold tracking-wide text-gray-600 uppercase">
                            <th class="pb-3 px-4 text-center">No</th>
                            <th class="pb-3 px-4 text-center">Tanggal & Jam</th>
                            <th class="pb-3 px-4 text-center">Kode Bahan</th>
                            <th class="pb-3 px-4 text-center">Nama Bahan</th>
                            <th class="pb-3 px-4 text-center">Jumlah Keluar</th>
                            <th class="pb-3 px-4 text-center">Nama Pengambil</th>
                            <th class="pb-3 px-4 text-center">Tujuan Penggunaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs->where('tipe_transaksi', 'keluar') as $log)
                            <tr class="row-data border-b border-gray-50 hover:bg-gray-50 transition-colors" data-jumlah="{{ $log->jumlah }}">
                                <td class="py-3 px-4 text-center text-sm text-navy-700 row-number">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-center text-sm font-medium text-navy-700">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                <td class="py-3 px-4 text-center text-sm font-bold text-navy-700">{{ $log->kode_bahan }}</td>
                                <td class="py-3 px-4 text-center text-sm font-medium text-navy-700">{{ $log->nama_bahan }}</td>
                                <td class="py-3 px-4 text-center text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-horizonRed-500">
                                        {{ $log->jumlah }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $log->nama_pengambil ?? 'N/A' }}</td>
                                <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $log->tujuan ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr class="no-data">
                                <td colspan="7" class="py-6 text-center text-sm text-gray-500 italic">Tidak ada data transaksi keluar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- LAPORAN RETUR BAHAN --}}
        <div class="horizon-card w-full p-4 overflow-hidden mb-6 section-laporan" id="section-retur">
            <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-4">
                <h5 class="text-lg font-bold text-navy-700">Laporan Retur Bahan</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-laporan">
                    <thead>
                        <tr class="border-b border-gray-200 text-left text-sm font-bold tracking-wide text-gray-600 uppercase">
                            <th class="pb-3 px-4 text-center">No</th>
                            <th class="pb-3 px-4 text-center">Tanggal</th>
                            <th class="pb-3 px-4 text-center">Kode Bahan</th>
                            <th class="pb-3 px-4 text-center">Nama Bahan</th>
                            <th class="pb-3 px-4 text-center">Jumlah Retur</th>
                            <th class="pb-3 px-4 text-center">Keterangan</th>
                            <th class="pb-3 px-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs->where('tipe_transaksi', 'retur') as $log)
                            <tr class="row-data border-b border-gray-50 hover:bg-gray-50 transition-colors" data-jumlah="{{ $log->jumlah }}">
                                <td class="py-3 px-4 text-center text-sm text-navy-700 row-number">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4 text-center text-sm font-medium text-navy-700">{{ $log->created_at->format('Y-m-d') }}</td>
                                <td class="py-3 px-4 text-center text-sm font-bold text-navy-700">{{ $log->kode_bahan }}</td>
                                <td class="py-3 px-4 text-center text-sm font-medium text-navy-700">{{ $log->nama_bahan }}</td>
                                <td class="py-3 px-4 text-center text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-500">
                                        {{ $log->jumlah }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $log->keterangan ?? 'N/A' }}</td>
                                <td class="py-3 px-4 text-center text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $log->status == 'selesai' ? 'bg-green-100 text-horizonGreen-500' : 'bg-orange-100 text-horizonOrange-500' }}">
                                        {{ ucfirst($log->status ?? 'N/A') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr class="no-data">
                                <td colspan="7" class="py-6 text-center text-sm text-gray-500 italic">Tidak ada data retur bahan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- CHART --}}
        <div class="horizon-card w-full p-6 mb-10">
            <div style="height: 350px;">
                <canvas id="chartBahan"></canvas>
            </div>
        </div>
    </div>

    @push('page-js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctxBahan = document.getElementById('chartBahan').getContext('2d');
            const myChartBahan = new Chart(ctxBahan, {
                type: 'bar',
                data: {
                    labels: ['Masuk', 'Keluar', 'Retur'],
                    datasets: [{
                        label: 'Jumlah Terfilter',
                        data: [0, 0, 0],
                        backgroundColor: [
                            '#01B574', // horizonGreen-500
                            '#E31A1A', // horizonRed-500
                            '#3b82f6'  // blue-500
                        ],
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } },
                    plugins: { legend: { display: true, position: 'top' } }
                }
            });

            function updateChartData() {
                let totalMasuk = 0;
                let totalKeluar = 0;
                let totalRetur = 0;

                document.querySelectorAll('#section-masuk tr.row-data').forEach(row => {
                    if (row.style.display !== 'none') {
                        totalMasuk += parseFloat(row.getAttribute('data-jumlah')) || 0;
                    }
                });

                document.querySelectorAll('#section-keluar tr.row-data').forEach(row => {
                    if (row.style.display !== 'none') {
                        totalKeluar += parseFloat(row.getAttribute('data-jumlah')) || 0;
                    }
                });

                document.querySelectorAll('#section-retur tr.row-data').forEach(row => {
                    if (row.style.display !== 'none') {
                        totalRetur += parseFloat(row.getAttribute('data-jumlah')) || 0;
                    }
                });

                myChartBahan.data.datasets[0].data = [totalMasuk, totalKeluar, totalRetur];
                myChartBahan.update();
            }

            document.getElementById('searchLaporan').addEventListener('keyup', function() {
                let filter = this.value.toLowerCase();
                document.querySelectorAll('.table-laporan').forEach(table => {
                    let rows = table.querySelectorAll('tbody tr.row-data');
                    let visibleCount = 1;

                    rows.forEach(row => {
                        let text = row.innerText.toLowerCase();
                        if (text.includes(filter)) {
                            row.style.display = '';
                            row.querySelector('.row-number').textContent = visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
                
                updateChartData();
            });

            window.addEventListener('DOMContentLoaded', updateChartData);

            document.getElementById('filter').addEventListener('change', function() {
                const bulanContainer = document.getElementById('bulan-container');
                const tahunContainer = document.getElementById('tahun-container');
                if (this.value === 'minggu') {
                    bulanContainer.classList.add('hidden');
                    tahunContainer.classList.add('hidden');
                } else if (this.value === 'bulan') {
                    bulanContainer.classList.remove('hidden');
                    tahunContainer.classList.remove('hidden');
                } else if (this.value === 'tahun') {
                    bulanContainer.classList.add('hidden');
                    tahunContainer.classList.remove('hidden');
                }
            });
            updateChartData();
        });
    </script>
    @endpush
</x-app-layout>