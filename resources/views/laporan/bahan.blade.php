<x-app-layout>
    <div class="bg-[#2A446C] h-full pl-72 pt-40">
        <div class="flex justify-start pl-[200px] text-3xl mb-8 text-white font-bold">
            Laporan Bahan Baku
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-20">

            {{-- FILTER WAKTU (Tidak Diubah) --}}
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <form method="GET" action="{{ route('laporan.bahan') }}" class="flex flex-wrap gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Filter</label>
                        <select name="filter" id="filter"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="minggu" {{ $filter == 'minggu' ? 'selected' : '' }}>Per Minggu</option>
                            <option value="bulan" {{ $filter == 'bulan' ? 'selected' : '' }}>Per Bulan</option>
                            <option value="tahun" {{ $filter == 'tahun' ? 'selected' : '' }}>Per Tahun</option>
                        </select>
                    </div>

                    <div id="bulan-container" class="{{ $filter != 'bulan' ? 'hidden' : '' }}">
                        <label class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="bulan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}"
                                    {{ request('bulan', Carbon\Carbon::now()->month) == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                            @endfor
                        </select>
                    </div>

                    <div id="tahun-container" class="{{ $filter == 'minggu' ? 'hidden' : '' }}">
                        <label class="block text-sm font-medium text-gray-700">Tahun</label>
                        <select name="tahun"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @for ($year = 2020; $year <= 2030; $year++)
                                <option value="{{ $year }}"
                                    {{ request('tahun', Carbon\Carbon::now()->year) == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Filter
                    </button>
                </form>
            </div>

            {{-- FITUR SEARCH --}}
            <div class="mb-6 w-1/3">
                <input type="text" id="searchLaporan" placeholder="Cari di semua laporan..."
                    class="w-full p-3 rounded-lg bg-[#FFFFFF33] text-white border border-gray-600
                           focus:ring-2 focus:ring-blue-500 placeholder-gray-400">
            </div>

            {{-- LAPORAN BAHAN MASUK --}}
            <div class="mb-10 section-laporan" id="section-masuk">
                <h2 class="text-2xl font-bold text-white mb-4">Laporan Bahan Masuk</h2>
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 table-laporan">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-2 text-center">No</th>
                                <th class="px-6 py-2 text-center">Tanggal</th>
                                <th class="px-6 py-2 text-center">Kode Bahan</th>
                                <th class="px-6 py-2 text-center">Nama Bahan</th>
                                <th class="px-6 py-2 text-center">Supplier</th>
                                <th class="px-6 py-2 text-center">Jumlah Tambah</th>
                                <th class="px-6 py-2 text-center">Sisa Stok Saat Itu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs->where('tipe_transaksi', 'masuk') as $log)
                                {{-- Ditambahkan data-jumlah untuk hitung chart --}}
                                <tr class="row-data border-b border-gray-100 hover:bg-gray-50 transition-colors" data-jumlah="{{ $log->jumlah }}">
                                    <td class="text-center py-4 row-number">{{ $loop->iteration }}</td>
                                    <td class="text-center py-4">{{ $log->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center py-4">{{ $log->kode_bahan }}</td>
                                    <td class="text-center py-4">{{ $log->nama_bahan }}</td>
                                    <td class="text-center py-4">{{ $log->supplier ?? 'N/A' }}</td>
                                    <td class="text-center py-4">{{ $log->jumlah }}</td>
                                    <td class="text-center py-4">{{ $log->sisa_stok ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr class="no-data">
                                    <td colspan="7" class="text-center py-10 text-gray-500 italic">Tidak ada data tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- LAPORAN PENGAMBILAN BAHAN --}}
            <div class="mb-10 section-laporan" id="section-keluar">
                <h2 class="text-2xl font-bold text-white mb-4">Laporan Pengambilan Bahan (Keluar)</h2>
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 table-laporan">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-2 text-center">No</th>
                                <th class="px-6 py-2 text-center">Tanggal & Jam</th>
                                <th class="px-6 py-2 text-center">Kode Bahan</th>
                                <th class="px-6 py-2 text-center">Nama Bahan</th>
                                <th class="px-6 py-2 text-center">Jumlah Keluar</th>
                                <th class="px-6 py-2 text-center">Nama Pengambil</th>
                                <th class="px-6 py-2 text-center">Tujuan Penggunaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs->where('tipe_transaksi', 'keluar') as $log)
                                {{-- Ditambahkan data-jumlah untuk hitung chart --}}
                                <tr class="row-data border-b border-gray-100 hover:bg-gray-50 transition-colors" data-jumlah="{{ $log->jumlah }}">
                                    <td class="text-center py-4 row-number">{{ $loop->iteration }}</td>
                                    <td class="text-center py-4">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="text-center py-4">{{ $log->kode_bahan }}</td>
                                    <td class="text-center py-4">{{ $log->nama_bahan }}</td>
                                    <td class="text-center py-4">{{ $log->jumlah }}</td>
                                    <td class="text-center py-4">{{ $log->nama_pengambil ?? 'N/A' }}</td>
                                    <td class="text-center py-4">{{ $log->tujuan ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr class="no-data">
                                    <td colspan="7" class="text-center py-10 text-gray-500 italic">Tidak ada data transaksi keluar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- LAPORAN RETUR BAHAN --}}
            <div class="pb-10 section-laporan" id="section-retur">
                <h2 class="text-2xl font-bold text-white mb-4">Laporan Retur Bahan</h2>
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 table-laporan">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-2 text-center">No</th>
                                <th class="px-6 py-2 text-center">Tanggal</th>
                                <th class="px-6 py-2 text-center">Kode Bahan</th>
                                <th class="px-6 py-2 text-center">Nama Bahan</th>
                                <th class="px-6 py-2 text-center">Jumlah Retur</th>
                                <th class="px-6 py-2 text-center">Keterangan</th>
                                <th class="px-6 py-2 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs->where('tipe_transaksi', 'retur') as $log)
                                {{-- Ditambahkan data-jumlah untuk hitung chart --}}
                                <tr class="row-data border-b border-gray-100 hover:bg-gray-50 transition-colors" data-jumlah="{{ $log->jumlah }}">
                                    <td class="text-center py-4 row-number">{{ $loop->iteration }}</td>
                                    <td class="text-center py-4">{{ $log->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center py-4">{{ $log->kode_bahan }}</td>
                                    <td class="text-center py-4">{{ $log->nama_bahan }}</td>
                                    <td class="text-center py-4">{{ $log->jumlah }}</td>
                                    <td class="text-center py-4">{{ $log->keterangan ?? 'N/A' }}</td>
                                    <td class="text-center py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $log->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ $log->status ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr class="no-data">
                                    <td colspan="7" class="text-center py-10 text-gray-500 italic">Tidak ada data retur bahan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- CHART --}}
            <div class="bg-white rounded-xl shadow p-4">
                <canvas id="chartBahan" width="400" height="200"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // 1. INISIALISASI CHART (Variabel dibuat global agar bisa diakses fungsi search)
        const ctxBahan = document.getElementById('chartBahan').getContext('2d');
        const myChartBahan = new Chart(ctxBahan, {
            type: 'bar',
            data: {
                labels: ['Masuk', 'Keluar', 'Retur'],
                datasets: [{
                    label: 'Jumlah Terfilter',
                    data: [0, 0, 0], // Diisi dinamis oleh fungsi updateChart
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: true, position: 'top' } }
            }
        });

        // 2. FUNGSI UPDATE CHART (Membaca data dari tabel yang terlihat)
        function updateChartData() {
            let totalMasuk = 0;
            let totalKeluar = 0;
            let totalRetur = 0;

            // Hitung data di bagian Masuk
            document.querySelectorAll('#section-masuk tr.row-data').forEach(row => {
                if (row.style.display !== 'none') {
                    totalMasuk += parseFloat(row.getAttribute('data-jumlah')) || 0;
                }
            });

            // Hitung data di bagian Keluar
            document.querySelectorAll('#section-keluar tr.row-data').forEach(row => {
                if (row.style.display !== 'none') {
                    totalKeluar += parseFloat(row.getAttribute('data-jumlah')) || 0;
                }
            });

            // Hitung data di bagian Retur
            document.querySelectorAll('#section-retur tr.row-data').forEach(row => {
                if (row.style.display !== 'none') {
                    totalRetur += parseFloat(row.getAttribute('data-jumlah')) || 0;
                }
            });

            // Update Chart secara real-time
            myChartBahan.data.datasets[0].data = [totalMasuk, totalKeluar, totalRetur];
            myChartBahan.update();
        }

        // 3. SCRIPT SEARCH (Ditambah fungsi updateChartData)
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
            
            // Panggil fungsi sinkronisasi chart
            updateChartData();
        });

        // Jalankan update chart saat halaman pertama kali dibuka
        window.addEventListener('DOMContentLoaded', updateChartData);

        // 4. FILTER DINAMIS (Bawaan Anda, tidak diubah)
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
    </script>
</x-app-layout>