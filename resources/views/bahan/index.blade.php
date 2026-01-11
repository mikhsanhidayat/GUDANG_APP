<x-app-layout>
    <div class="bg-[#2A446C] min-h-screen pl-72 pt-40">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ALERT ERROR JIKA STOK KURANG --}}
            @if ($errors->has('stok_ambil'))
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto text-center">
                        <p class="text-red-600 text-lg font-semibold mb-4">{{ $errors->first('stok_ambil') }}</p>
                        <button onclick="this.parentElement.parentElement.style.display='none'"
                            class="bg-red-600 text-white px-6 py-2 rounded-lg">Tutup</button>
                    </div>
                </div>
            @endif
            {{-- ALERT ERROR JIKA KODE BAHAN SUDAH ADA --}}
            @if ($errors->has('kode_bahan'))
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto text-center">
                        <p class="text-red-600 text-lg font-semibold mb-4">{{ $errors->first('kode_bahan') }}</p>
                        <button onclick="this.parentElement.parentElement.style.display='none'"
                            class="bg-red-600 text-white px-4 py-2 rounded-lg">Tutup</button>
                    </div>
                </div>
            @endif

            @can('create', $item = new App\Models\User())
                {{-- TOMBOL TAMBAH --}}
                <div class="flex justify-start text-2xl mb-6">
                    <a href="{{ route('bahan.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-bold py-2 px-4 shadow-lg">
                        Tambah Bahan
                    </a>
                </div>
            @endcan

            {{-- SEARCH --}}
            {{-- SEARCH & REFRESH --}}
            <div class="mb-4 w-1/3 flex gap-2">
                <div class="relative flex-1">
                    <input type="text" id="search" placeholder="Cari Bahan..."
                        class="w-full p-3 rounded-lg bg-[#FFFFFF33] text-white border border-gray-600
                   focus:ring-2 focus:ring-blue-500 placeholder-gray-400">
                </div>
                <button type="button" id="btnRefresh"
                    class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg transition duration-200 shadow-lg flex items-center justify-center"
                    title="Refresh Pencarian">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>
            </div>

            {{-- TABLE --}}
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-2 text-center">No</th>
                            <th class="px-6 py-2 text-center">Kode</th>
                            <th class="px-6 py-2 text-center">Nama</th>
                            <th class="px-6 py-2 text-center">Warna</th>
                            <th class="px-6 py-2 text-center">Stok</th>
                            <th class="px-6 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($bahans as $bahan)
                            {{-- Menambahkan border-b untuk garis bawah dan hover effect --}}
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                {{-- Menambahkan py-4 untuk memberikan space atas & bawah --}}
                                <td class="row-number text-center py-4">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center py-4">{{ $bahan->kode_bahan }}</td>
                                <td class="text-center py-4">{{ $bahan->nama_bahan }}</td>
                                <td class="text-center py-4">{{ $bahan->warna }}</td>
                                <td class="text-center py-4">{{ $bahan->stok_tersedia }}</td>

                                <td class="text-center py-4">
                                    {{-- TOMBOL AMBIL --}}
                                    @can('ambil', $bahan)
                                        <button
                                            class="ambil-btn bg-red-600 hover:bg-red-700 text-white px-2 py-[2px] rounded-full mr-1
                    {{ $bahan->stok_tersedia == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            data-id="{{ $bahan->id }}" data-nama="{{ $bahan->nama_bahan }}"
                                            {{ $bahan->stok_tersedia == 0 ? 'disabled' : '' }}>
                                            Ambil
                                        </button>
                                    @endcan

                                    {{-- TOMBOL RETUR --}}
                                    @can('retur', $bahan)
                                        <button
                                            class="retur-btn bg-purple-600 hover:bg-purple-700 text-white px-2 py-[2px] rounded-full mr-1"
                                            data-id="{{ $bahan->id }}" data-nama="{{ $bahan->nama_bahan }}">
                                            Retur
                                        </button>
                                    @endcan

                                    {{-- TOMBOL TAMBAH --}}
                                    @can('tambah', $bahan)
                                        <button
                                            class="tambah-btn bg-orange-500 hover:bg-orange-600 text-white px-2 py-[2px] rounded-full ml-1"
                                            data-id="{{ $bahan->id }}" data-nama="{{ $bahan->nama_bahan }}">
                                            Tambah
                                        </button>
                                    @endcan

                                    {{-- TOMBOL EDIT --}}
                                    @can('update', $item = new App\Models\User())
                                        <button
                                            class="edit-btn bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-[2px] rounded-full"
                                            data-id="{{ $bahan->id }}" data-nama="{{ $bahan->nama_bahan }}"
                                            data-warna="{{ $bahan->warna }}" data-stok="{{ $bahan->stok_tersedia }}">
                                            Edit
                                        </button>
                                    @endcan

                                    {{-- TOMBOL HAPUS --}}
                                    @can('create', $item = new App\Models\User())
                                        <form action="{{ route('bahan.destroy', $bahan) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Yakin hapus?')"
                                                class="bg-red-600 hover:bg-red-700 text-white px-2 py-[2px] rounded-full">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 px-4 pr-14 pb-4 pagination-custom">
                    {{ $bahans->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MODAL TAMBAH STOK ================= --}}
    <div id="tambah-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-1/3 shadow-xl">
            <h3 class="font-bold text-xl mb-4">Tambah Stok Bahan</h3>
            <p class="mb-3">Bahan: <strong id="tambah_nama"></strong></p>

            <form id="tambahForm" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block mb-1">Jumlah Stok</label>
                    <input type="number" name="stok_tambah" min="1" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Nama Supplier</label>
                    <input type="text" name="supplier" class="w-full border rounded p-2" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeTambahModal"
                        class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MODAL AMBIL STOK ================= --}}
    <div id="ambil-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-1/3 shadow-xl">
            <h3 class="font-bold text-xl mb-4 text-red-600">Ambil Stok Bahan</h3>
            <p class="mb-3">Bahan: <strong id="ambil_nama"></strong></p>

            <form id="ambilForm" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block mb-1">Jumlah Pengambilan</label>
                    <input type="number" name="stok_ambil" min="1" class="w-full border rounded p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Nama Pengambil</label>
                    <input type="text" name="nama_pengambil" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Tujuan Penggunaan</label>
                    <textarea name="tujuan" class="w-full border rounded p-2" rows="3" required></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeAmbilModal"
                        class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Ambil</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MODAL RETUR ================= --}}
    <div id="retur-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-1/3 shadow-xl">
            <h3 class="font-bold text-xl mb-4 text-purple-600">Retur Bahan</h3>
            <p class="mb-3">Bahan: <strong id="retur_nama"></strong></p>

            <form id="returForm" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block mb-1">Jumlah Retur</label>
                    <input type="number" name="jumlah_retur" min="1" class="w-full border rounded p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block mb-1">Keterangan</label>
                    <textarea name="keterangan" class="w-full border rounded p-2" rows="3"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeReturModal"
                        class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Retur</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MODAL EDIT ================= --}}
    {{-- ================= MODAL EDIT ================= --}}
    <div id="edit-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg w-1/3 shadow-xl">
            <h3 class="font-bold text-xl mb-4">Edit Data Bahan</h3>
            <form id="editForm" method="POST">
                @csrf @method('PUT')

                {{-- Tambahkan preview kode di modal edit --}}
                <div class="mb-2">
                    <label class="text-sm text-gray-500">Preview Kode Baru</label>
                    <input id="edit_kode" name="kode_bahan" class="w-full border rounded p-2 bg-gray-100" readonly>
                </div>

                <div class="mb-2">
                    <label>Nama Bahan</label>
                    <input id="edit_nama" name="nama_bahan" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-2">
                    <label>Warna</label>
                    <input id="edit_warna" name="warna" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label>Stok Tersedia</label>
                    <input id="edit_stok" name="stok_tersedia" type="number" class="w-full border rounded p-2"
                        required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeEditModal"
                        class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= SCRIPT ================= --}}
    <script>
        // SEARCH
        document.getElementById('search').addEventListener('keyup', function() {
            let no = 1;
            let filter = this.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                if (row.textContent.toLowerCase().includes(filter)) {
                    row.style.display = '';
                    row.querySelector('.row-number').textContent = no++;
                } else row.style.display = 'none';
            });
        });

        // MODAL ELEMENTS
        const tambahModal = document.getElementById('tambah-modal');
        const ambilModal = document.getElementById('ambil-modal');
        const editModal = document.getElementById('edit-modal');

        // LOGIKA TOMBOL TAMBAH
        document.querySelectorAll('.tambah-btn').forEach(btn => {
            btn.onclick = () => {
                document.getElementById('tambah_nama').textContent = btn.dataset.nama;
                document.getElementById('tambahForm').action = `/bahan/${btn.dataset.id}/tambah-stok`;
                tambahModal.classList.remove('hidden');
            }
        });

        // LOGIKA TOMBOL AMBIL (Tambahkan Bagian Ini)
        document.querySelectorAll('.ambil-btn').forEach(btn => {
            btn.onclick = () => {
                document.getElementById('ambil_nama').textContent = btn.dataset.nama;
                document.getElementById('ambilForm').action =
                    `/bahan/${btn.dataset.id}/ambil-stok`; // Sesuaikan URL route Anda
                document.getElementById('ambil-modal').classList.remove('hidden');
            }
        });

        // Pastikan tombol close juga berfungsi (Cari bagian CLOSE MODALS dan pastikan baris ini ada)
        document.getElementById('closeAmbilModal').onclick = () => {
            document.getElementById('ambil-modal').classList.add('hidden');
        };

        // LOGIKA TOMBOL AMBIL
        // Tambahkan fungsi ini di dalam tag <script> Anda

        function updateEditKode() {
            const nama = document.getElementById('edit_nama').value.trim();
            const warna = document.getElementById('edit_warna').value.trim();

            if (nama.length >= 3 && warna.length >= 1) {
                const kodeNama = nama.substring(0, 3).toUpperCase();
                const kodeWarna = warna.charAt(0).toUpperCase();
                document.getElementById('edit_kode').value = `${kodeNama}-${kodeWarna}`;
            }
        }

        // Pasang event listener pada input di dalam modal edit
        document.getElementById('edit_nama').addEventListener('input', updateEditKode);
        document.getElementById('edit_warna').addEventListener('input', updateEditKode);

        // Update bagian LOGIKA TOMBOL EDIT yang sudah ada:
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.onclick = () => {
                document.getElementById('edit_nama').value = btn.dataset.nama;
                document.getElementById('edit_warna').value = btn.dataset.warna;
                document.getElementById('edit_stok').value = btn.dataset.stok;

                // Panggil fungsi ini agar kode langsung muncul saat modal dibuka
                updateEditKode();

                document.getElementById('editForm').action = `/bahan/${btn.dataset.id}`;
                editModal.classList.remove('hidden');
            }
        });

        // CLOSE MODALS
        document.getElementById('closeTambahModal').onclick = () => tambahModal.classList.add('hidden');
        document.getElementById('closeAmbilModal').onclick = () => ambilModal.classList.add('hidden');
        document.getElementById('closeEditModal').onclick = () => editModal.classList.add('hidden');

        // ===== RETUR MODAL =====
        const returModal = document.getElementById('retur-modal');
        const returButtons = document.querySelectorAll('.retur-btn');
        const closeReturModal = document.getElementById('closeReturModal');
        const returForm = document.getElementById('returForm');

        returButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('retur_nama').textContent = btn.dataset.nama;
                returForm.action = `/bahan/${btn.dataset.id}/retur`;
                returModal.classList.remove('hidden');
            });
        });

        closeReturModal.addEventListener('click', () => {
            returModal.classList.add('hidden');
        });


        // Fungsi Utama Search
        function performSearch() {
            let no = 1;
            let filter = document.getElementById('search').value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                if (row.textContent.toLowerCase().includes(filter)) {
                    row.style.display = '';
                    // Update nomor urut hanya untuk yang tampil
                    const numCell = row.querySelector('.row-number');
                    if (numCell) numCell.textContent = no++;
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Event saat mengetik
        document.getElementById('search').addEventListener('keyup', performSearch);

        // Event Tombol Refresh
        document.getElementById('btnRefresh').onclick = function() {
            // 1. Kosongkan input
            document.getElementById('search').value = '';

            // 2. Jalankan pencarian (akan menampilkan semua karena filter kosong)
            performSearch();

            // 3. Animasi putar pada icon (opsional agar keren)
            const icon = this.querySelector('svg');
            icon.classList.add('animate-spin');
            setTimeout(() => icon.classList.remove('animate-spin'), 500);
        };

        // ... (Logika Modal dan lainnya tetap sama di bawah) ...
    </script>
</x-app-layout>
