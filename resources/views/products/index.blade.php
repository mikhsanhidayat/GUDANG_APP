<x-app-layout >
    <div class="bg-[#2A446C] min-h-screen pl-72 pt-40">
        <div class="max-w-7xl mx-auto pb-10  sm:px-6 lg:px-8">
            <div class="w-full">
                @if ($errors->has('kode_produk'))
                    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
                            <p class="text-red-600 text-lg font-semibold mb-4">{{ $errors->first('kode_produk') }}</p>
                            <button onclick="this.parentElement.parentElement.style.display='none'"
                                class="bg-red-600 text-white px-4 py-2 rounded">Tutup</button>
                        </div>
                    </div>
                @endif

                @if ($errors->has('stok_ambil'))
                    <div class  ="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
                            <p class="text-red-600 text-lg font-semibold mb-4">
                                Pengambilan melebihi stock
                            </p>
                            <button onclick="this.parentElement.parentElement.style.display='none'"
                                class="bg-red-600 text-white px-4 py-2 rounded">
                                Tutup
                            </button>
                        </div>
                    </div>
                @endif

                @can('view', $item = new App\Models\Product())
                    <div class="flex justify-start text-2xl mb-6">
                        <a href="{{ route('products.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-bold py-2 px-4 shadow-lg">
                            Tambah Produk
                        </a>
                    </div>
                @endcan

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

                <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                    <table class="min-w-full divide-y  divide-gray-200">
                        <thead class="bg-gray-200 ">
                            <tr>
                                <th class="px-6 py-2  text-center">No</th>
                                <th class="px-6 py-2 text-center">Kode Produk</th>
                                <th class="px-6 py-2 text-center">Nama Produk</th>
                                <th class="px-6 py-2 text-center">Warna</th>
                                <th class="px-6 py-2 text-center">Logo</th>
                                <th class="px-6 py-2 text-center">Stok</th>
                                <th class="px-6 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="text-center row-number py-4">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="text-center py-4">{{ $product->kode_produk }}</td>
                                    <td class="text-center py-4">{{ $product->nama_produk }}</td>
                                    <td class="text-center py-4">{{ $product->warna }}</td>
                                    <td class="text-center py-4">{{ $product->logo }}</td>
                                    <td class="text-center py-4">{{ $product->stok_tersedia }}</td>

                                    <td class="text-center py-4">
                                        {{-- TOMBOL AMBIL STOK --}}
                                        @can('ambil', $product)
                                            <button
                                                class="ambil-btn bg-red-600 hover:bg-red-700 text-white px-2 py-[2px] rounded-full mr-1
                        {{ $product->stok_tersedia == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                data-id="{{ $product->id }}" data-nama="{{ $product->nama_produk }}"
                                                {{ $product->stok_tersedia == 0 ? 'disabled' : '' }}>
                                                Ambil
                                            </button>
                                        @endcan

                                        {{-- TOMBOL RETUR --}}
                                        @can('retur', $product)
                                            <button
                                                class="retur-btn bg-purple-600 hover:bg-purple-700 text-white px-2 py-[2px] rounded-full mr-1"
                                                data-id="{{ $product->id }}" data-nama="{{ $product->nama_produk }}">
                                                Retur
                                            </button>
                                        @endcan

                                        {{-- TOMBOL TAMBAH STOK --}}
                                        @can('tambah', $product)
                                            <button
                                                class="tambah-btn bg-orange-500 hover:bg-orange-600 text-white px-2 py-[2px] rounded-full ml-1"
                                                data-id="{{ $product->id }}" data-nama="{{ $product->nama_produk }}">
                                                Tambah
                                            </button>
                                        @endcan

                                        {{-- TOMBOL EDIT --}}
                                        @can('update', $product)
                                            <button
                                                class="edit-btn bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-[2px] rounded-full"
                                                data-id="{{ $product->id }}" data-nama="{{ $product->nama_produk }}"
                                                data-warna="{{ $product->warna }}" data-logo="{{ $product->logo }}"
                                                data-stok="{{ $product->stok_tersedia }}">
                                                Edit
                                            </button>
                                        @endcan

                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            @can('delete', $product)
                                                <button onclick="return confirm('Yakin hapus?')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-2 py-[2px] rounded-full">
                                                    Hapus
                                                </button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 px-4 pr-14 pb-4 pagination-custom">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MODAL TAMBAH STOK ================= --}}
    <div id="tambah-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Tambah Stok Produk</h3>
            <p class="mb-3">
                Produk: <strong id="tambah_nama"></strong>
            </p>
            <form id="tambahForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label>Jumlah Stok</label>
                    <input type="number" name="stok_tambah" min="1" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label>Petugas/Admin</label>
                    <input type="text" name="petugas" class="w-full border rounded p-2" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeTambahModal" class="px-4 py-2 bg-gray-400 rounded text-white">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-orange-500 rounded text-white">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- modal ambil stock --}}
    <div id="ambil-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Ambil Stok Produk</h3>
            <p class="mb-3">
                Produk: <strong id="ambil_nama"></strong>
            </p>
            <form id="ambilForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label>Jumlah Stok</label>
                    <input type="number" name="stok_ambil" min="1" class="w-full border rounded p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label>Penerima/Customer</label>
                    <input type="text" name="penerima" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="w-full border rounded p-2" rows="3"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeAmbilModal" class="px-4 py-2 bg-gray-400 rounded text-white">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                        Ambil
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MODAL RETUR ================= --}}
    <div id="retur-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Retur Produk</h3>
            <p class="mb-3">
                Produk: <strong id="retur_nama"></strong>
            </p>
            <form id="returForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label>Jumlah Retur</label>
                    <input type="number" name="jumlah_retur" min="1" class="w-full border rounded p-2"
                        required>
                </div>
                <div class="mb-4">
                    <label>Kondisi</label>
                    <select name="kondisi" class="w-full border rounded p-2" required>
                        <option value="bagus">Bagus</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="w-full border rounded p-2" rows="3"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeReturModal" class="px-4 py-2 bg-gray-400 rounded text-white">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 rounded text-white">
                        Retur
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MODAL EDIT ================= --}}
    <div id="crud-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex  items-center justify-center z-50">
        <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Edit Produk</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" id="modal_nama" class="w-full border rounded p-2"
                        required>
                </div>
                <div class="mb-3">
                    <label>Warna</label>
                    <input type="text" name="warna" id="modal_warna" class="w-full border rounded p-2"
                        required>
                </div>
                <div class="mb-3">
                    <label>Logo</label>
                    <select name="logo" id="modal_logo" class="w-full border rounded p-2" required>
                        <option value="IBI">IBI</option>
                        <option value="IDI">IDI</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok_tersedia" id="modal_stok" class="w-full border rounded p-2"
                        min="0" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="closeModal" class="px-4 py-2 bg-gray-400 rounded text-white">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 rounded text-white">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT PENCARIAN & MODAL --}}
    <script>
        // SCRIPT SEARCH DENGAN RE-NUMBERING
        document.getElementById('search').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let visibleCount = 1;

            document.querySelectorAll('tbody tr').forEach(row => {
                let textMatch = row.textContent.toLowerCase().includes(filter);
                if (textMatch) {
                    row.style.display = '';
                    let numberCell = row.querySelector('.row-number');
                    if (numberCell) {
                        numberCell.textContent = visibleCount++;
                    }
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // ===== EDIT MODAL =====
        const editModal = document.getElementById('crud-modal');
        const editButtons = document.querySelectorAll('.edit-btn');
        const closeModal = document.getElementById('closeModal');
        const editForm = document.getElementById('editForm');

        editButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('modal_nama').value = btn.dataset.nama;
                document.getElementById('modal_warna').value = btn.dataset.warna;
                document.getElementById('modal_logo').value = btn.dataset.logo;
                document.getElementById('modal_stok').value = btn.dataset.stok;
                editForm.action = `/products/${btn.dataset.id}`;
                editModal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            editModal.classList.add('hidden');
        });

        // ===== TAMBAH STOK MODAL =====
        const tambahModal = document.getElementById('tambah-modal');
        const tambahButtons = document.querySelectorAll('.tambah-btn');
        const closeTambahModal = document.getElementById('closeTambahModal');
        const tambahForm = document.getElementById('tambahForm');
        tambahButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('tambah_nama').textContent = btn.dataset.nama;
                tambahForm.action = `/products/${btn.dataset.id}/tambah-stok`;
                tambahModal.classList.remove('hidden');
            });
        });
        closeTambahModal.addEventListener('click', () => {
            tambahModal.classList.add('hidden');
        });

        // ===== AMBIL STOK MODAL =====
        const ambilModal = document.getElementById('ambil-modal');
        const ambilButtons = document.querySelectorAll('.ambil-btn');
        const closeAmbilModal = document.getElementById('closeAmbilModal');
        const ambilForm = document.getElementById('ambilForm');

        ambilButtons.forEach(btn => {
            if (btn.disabled) return;
            btn.addEventListener('click', () => {
                document.getElementById('ambil_nama').textContent = btn.dataset.nama;
                ambilForm.action = `/products/${btn.dataset.id}/ambil-stok`;
                ambilModal.classList.remove('hidden');
            });
        });

        closeAmbilModal.addEventListener('click', () => {
            ambilModal.classList.add('hidden');
        });

        // ===== RETUR MODAL =====
        const returModal = document.getElementById('retur-modal');
        const returButtons = document.querySelectorAll('.retur-btn');
        const closeReturModal = document.getElementById('closeReturModal');
        const returForm = document.getElementById('returForm');

        returButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('retur_nama').textContent = btn.dataset.nama;
                returForm.action = `/products/${btn.dataset.id}/retur`;
                returModal.classList.remove('hidden');
            });
        });

        closeReturModal.addEventListener('click', () => {
            returModal.classList.add('hidden');
        });


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
