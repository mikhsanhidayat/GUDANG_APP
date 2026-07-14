<x-app-layout>
    <div class="w-full">
        <div class="w-full">
            @if ($errors->has('kode_bahan'))
                <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700 flex justify-between items-center" role="alert">
                    <span>{{ $errors->first('kode_bahan') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900"><i class="ti ti-x"></i></button>
                </div>
            @endif

            @if ($errors->has('stok_ambil'))
                <div class="mb-4 rounded-lg bg-red-100 p-4 text-sm text-red-700 flex justify-between items-center" role="alert">
                    <span>Pengambilan melebihi stock</span>
                    <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900"><i class="ti ti-x"></i></button>
                </div>
            @endif

            @can('create', $item = new App\Models\Bahan())
                <div class="mb-4">
                    <button class="create-btn inline-flex items-center justify-center rounded-xl bg-brand-500 px-5 py-3 text-base font-medium text-white transition duration-200 hover:bg-brand-600 active:bg-brand-700">
                        <i class="ti ti-plus mr-2"></i> Tambah Bahan Baku
                    </button>
                </div>
            @endcan

            <div class="horizon-card w-full p-4 overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between pb-4 border-b border-gray-100 mb-4 gap-4">
                    <h5 class="text-xl font-bold text-navy-700">Data Bahan Baku</h5>
                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <div class="flex h-10 items-center rounded-full bg-lightPrimary text-navy-700 w-full md:w-[250px]">
                            <p class="pl-3 pr-2 text-xl">
                                <i class="ti ti-search h-4 w-4 text-gray-400"></i>
                            </p>
                            <input type="text" id="search" placeholder="Cari Bahan..." class="block h-full w-full rounded-full bg-lightPrimary text-sm font-medium text-navy-700 outline-none placeholder:!text-gray-400 border-none focus:ring-0" />
                        </div>
                        <button type="button" id="btnRefresh" class="h-10 w-10 flex items-center justify-center rounded-full bg-lightPrimary text-brand-500 hover:bg-gray-200 transition">
                            <i class="ti ti-refresh"></i>
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 text-left text-sm font-bold tracking-wide text-gray-600 uppercase">
                                <th class="pb-3 px-4 text-center">No</th>
                                <th class="pb-3 px-4 text-center">Kode Bahan</th>
                                <th class="pb-3 px-4 text-center">Nama Bahan</th>
                                <th class="pb-3 px-4 text-center">Warna</th>
                                <th class="pb-3 px-4 text-center">Sisa Stok</th>
                                <th class="pb-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bahans as $bahan)
                                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4 text-center text-sm text-navy-700 row-number">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-4 text-center text-sm font-bold text-navy-700">{{ $bahan->kode_bahan }}</td>
                                    <td class="py-3 px-4 text-center text-sm font-medium text-navy-700">{{ $bahan->nama_bahan }}</td>
                                    <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $bahan->warna }}</td>
                                    <td class="py-3 px-4 text-center text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $bahan->stok_tersedia > 10 ? 'bg-green-100 text-horizonGreen-500' : 'bg-red-100 text-horizonRed-500' }}">
                                            {{ $bahan->stok_tersedia }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center flex flex-wrap justify-center gap-2">
                                        {{-- TOMBOL AMBIL --}}
                                        @can('ambil', $bahan)
                                            <button class="ambil-btn inline-flex items-center justify-center rounded-lg bg-horizonRed-500 px-3 py-1.5 text-xs font-medium text-white hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed"
                                                data-id="{{ $bahan->id }}" data-nama="{{ $bahan->nama_bahan }}"
                                                {{ $bahan->stok_tersedia == 0 ? 'disabled' : '' }}>
                                                Ambil
                                            </button>
                                        @endcan

                                        {{-- TOMBOL RETUR --}}
                                        @can('retur', $bahan)
                                            <button class="retur-btn inline-flex items-center justify-center rounded-lg bg-blue-500 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-600"
                                                data-id="{{ $bahan->id }}" data-nama="{{ $bahan->nama_bahan }}">
                                                Retur
                                            </button>
                                        @endcan

                                        {{-- TOMBOL TAMBAH --}}
                                        @can('tambah', $bahan)
                                            <button class="tambah-btn inline-flex items-center justify-center rounded-lg bg-horizonOrange-500 px-3 py-1.5 text-xs font-medium text-white hover:bg-orange-600"
                                                data-id="{{ $bahan->id }}" data-nama="{{ $bahan->nama_bahan }}">
                                                Tambah
                                            </button>
                                        @endcan

                                        {{-- TOMBOL EDIT --}}
                                        @can('update', $bahan)
                                            <button class="edit-btn inline-flex items-center justify-center rounded-lg bg-horizonGreen-500 px-3 py-1.5 text-xs font-medium text-white hover:bg-green-600"
                                                data-id="{{ $bahan->id }}" data-nama="{{ $bahan->nama_bahan }}"
                                                data-warna="{{ $bahan->warna }}" data-stok="{{ $bahan->stok_tersedia }}">
                                                Edit
                                            </button>
                                        @endcan

                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('bahan.destroy', $bahan) }}" method="POST" class="inline-block m-0">
                                            @csrf
                                            @method('DELETE')
                                            @can('delete', $bahan)
                                                <button onclick="return confirm('Yakin hapus?')" class="inline-flex items-center justify-center rounded-lg bg-gray-800 px-3 py-1.5 text-xs font-medium text-white hover:bg-gray-900">
                                                    Hapus
                                                </button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $bahans->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE BAHAN --}}
    <div id="create-modal" class="fixed inset-0 z-[100] hidden items-center justify-center overflow-auto bg-black/40 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-2xl rounded-[20px] bg-white shadow-3xl">
            <form id="createForm" action="{{ route('bahan.store') }}" method="POST">
                @csrf
                <div class="flex items-center justify-between border-b border-gray-100 p-5">
                    <h5 class="text-xl font-bold text-navy-700">Tambah Bahan Baku Baru</h5>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600"><i class="ti ti-x text-xl"></i></button>
                </div>
                <div class="p-5 max-h-[70vh] overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Kode Bahan</label>
                            <input type="text" name="kode_bahan" id="create_kode_bahan" value="{{ old('kode_bahan') }}"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0 bg-gray-50"
                                placeholder="Auto Generate" required>
                            <p class="mt-1 text-[10px] text-gray-400">*Bisa diedit manual jika tidak ingin auto-generate</p>
                        </div>
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Nama Bahan</label>
                            <input type="text" name="nama_bahan" id="create_nama_bahan" value="{{ old('nama_bahan') }}"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0"
                                placeholder="Contoh: Kain Parasut" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Warna</label>
                            <input type="text" name="warna" value="{{ old('warna') }}"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0"
                                placeholder="Contoh: Merah, Bening" required>
                        </div>
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Sisa Stok (Awal)</label>
                            <input type="number" name="stok_tersedia" value="{{ old('stok_tersedia', 0) }}" min="0"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end border-t border-gray-100 p-5 gap-3">
                    <button type="button" class="close-modal rounded-xl bg-gray-100 px-5 py-2.5 text-sm font-medium text-navy-700 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="rounded-xl bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-md shadow-brand-500/30">Simpan Bahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL TAMBAH STOK --}}
    <div id="tambah-modal" class="fixed inset-0 z-[100] hidden items-center justify-center overflow-auto bg-black/40 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-lg rounded-[20px] bg-white shadow-3xl">
            <form id="tambahForm" method="POST">
                @csrf
                @method('PUT')
                <div class="flex items-center justify-between border-b border-gray-100 p-5">
                    <h5 class="text-xl font-bold text-navy-700">Tambah Stok Bahan Baku</h5>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600"><i class="ti ti-x text-xl"></i></button>
                </div>
                <div class="p-5">
                    <p class="mb-4 text-sm text-gray-600">Bahan: <strong id="tambah_nama" class="text-navy-700"></strong></p>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Jumlah Masuk</label>
                        <input type="number" name="stok_tambah" min="1" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Supplier / Petugas</label>
                        <input type="text" name="supplier" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                    </div>
                </div>
                <div class="flex items-center justify-end border-t border-gray-100 p-5 gap-3">
                    <button type="button" class="close-modal rounded-xl bg-gray-100 px-5 py-2.5 text-sm font-medium text-navy-700 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="rounded-xl bg-horizonOrange-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-orange-600">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL AMBIL STOK --}}
    <div id="ambil-modal" class="fixed inset-0 z-[100] hidden items-center justify-center overflow-auto bg-black/40 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-lg rounded-[20px] bg-white shadow-3xl">
            <form id="ambilForm" method="POST">
                @csrf
                @method('PUT')
                <div class="flex items-center justify-between border-b border-gray-100 p-5">
                    <h5 class="text-xl font-bold text-navy-700">Ambil Bahan Baku</h5>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600"><i class="ti ti-x text-xl"></i></button>
                </div>
                <div class="p-5">
                    <p class="mb-4 text-sm text-gray-600">Bahan: <strong id="ambil_nama" class="text-navy-700"></strong></p>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Jumlah Diambil</label>
                        <input type="number" name="stok_ambil" min="1" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Nama Pengambil</label>
                        <input type="text" name="nama_pengambil" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Tujuan Penggunaan</label>
                        <textarea name="tujuan" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" rows="3"></textarea>
                    </div>
                </div>
                <div class="flex items-center justify-end border-t border-gray-100 p-5 gap-3">
                    <button type="button" class="close-modal rounded-xl bg-gray-100 px-5 py-2.5 text-sm font-medium text-navy-700 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="rounded-xl bg-horizonRed-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-600">Ambil</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL RETUR --}}
    <div id="retur-modal" class="fixed inset-0 z-[100] hidden items-center justify-center overflow-auto bg-black/40 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-lg rounded-[20px] bg-white shadow-3xl">
            <form id="returForm" method="POST">
                @csrf
                @method('PUT')
                <div class="flex items-center justify-between border-b border-gray-100 p-5">
                    <h5 class="text-xl font-bold text-navy-700">Retur Bahan Baku</h5>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600"><i class="ti ti-x text-xl"></i></button>
                </div>
                <div class="p-5">
                    <p class="mb-4 text-sm text-gray-600">Bahan: <strong id="retur_nama" class="text-navy-700"></strong></p>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Jumlah Retur</label>
                        <input type="number" name="jumlah_retur" min="1" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Keterangan / Alasan Retur</label>
                        <textarea name="keterangan" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" rows="3"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Status Retur</label>
                        <select name="status" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                            <option value="selesai">Selesai (Masuk Stok)</option>
                            <option value="pending">Pending (Menunggu Supplier)</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end border-t border-gray-100 p-5 gap-3">
                    <button type="button" class="close-modal rounded-xl bg-gray-100 px-5 py-2.5 text-sm font-medium text-navy-700 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="rounded-xl bg-blue-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-600">Retur</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="crud-modal" class="fixed inset-0 z-[100] hidden items-center justify-center overflow-auto bg-black/40 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-lg rounded-[20px] bg-white shadow-3xl">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="flex items-center justify-between border-b border-gray-100 p-5">
                    <h5 class="text-xl font-bold text-navy-700">Edit Data Bahan Baku</h5>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600"><i class="ti ti-x text-xl"></i></button>
                </div>
                <div class="p-5">
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Nama Bahan</label>
                        <input type="text" name="nama_bahan" id="modal_nama" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Warna</label>
                        <input type="text" name="warna" id="modal_warna" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Stok (Sisa)</label>
                        <input type="number" name="stok_tersedia" id="modal_stok" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" min="0" required>
                    </div>
                </div>
                <div class="flex items-center justify-end border-t border-gray-100 p-5 gap-3">
                    <button type="button" class="close-modal rounded-xl bg-gray-100 px-5 py-2.5 text-sm font-medium text-navy-700 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="rounded-xl bg-horizonGreen-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    @push('page-js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Helper function untuk Modal
            function openModal(id) {
                const modal = document.getElementById(id);
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
            function closeModal(modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }

            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', function() {
                    closeModal(this.closest('.fixed'));
                });
            });

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

            // ===== CREATE MODAL =====
            document.querySelectorAll('.create-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    openModal('create-modal');
                });
            });

            const inputNama = document.getElementById('create_nama_bahan');
            const inputKode = document.getElementById('create_kode_bahan');
            if (inputNama && inputKode) {
                inputNama.addEventListener('input', function() {
                    const nama = this.value;
                    if (nama.length > 0) {
                        const singkatan = nama.split(' ').map(word => word.charAt(0)).join('').toUpperCase();
                        const randomNum = Math.floor(100 + Math.random() * 900);
                        inputKode.value = 'BHN-' + singkatan + '-' + randomNum;
                    } else {
                        inputKode.value = '';
                    }
                });
            }

            // ===== EDIT MODAL =====
            const editForm = document.getElementById('editForm');
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('modal_nama').value = btn.dataset.nama;
                    document.getElementById('modal_warna').value = btn.dataset.warna;
                    document.getElementById('modal_stok').value = btn.dataset.stok;
                    editForm.action = `/bahan/${btn.dataset.id}`;
                    openModal('crud-modal');
                });
            });

            // ===== TAMBAH MODAL =====
            const tambahForm = document.getElementById('tambahForm');
            document.querySelectorAll('.tambah-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('tambah_nama').textContent = btn.dataset.nama;
                    tambahForm.action = `/bahan/${btn.dataset.id}/tambah-stok`;
                    openModal('tambah-modal');
                });
            });

            // ===== AMBIL MODAL =====
            const ambilForm = document.getElementById('ambilForm');
            document.querySelectorAll('.ambil-btn').forEach(btn => {
                if (btn.classList.contains('disabled')) return;
                btn.addEventListener('click', () => {
                    document.getElementById('ambil_nama').textContent = btn.dataset.nama;
                    ambilForm.action = `/bahan/${btn.dataset.id}/ambil-stok`;
                    openModal('ambil-modal');
                });
            });

            // ===== RETUR MODAL =====
            const returForm = document.getElementById('returForm');
            document.querySelectorAll('.retur-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('retur_nama').textContent = btn.dataset.nama;
                    returForm.action = `/bahan/${btn.dataset.id}/retur`;
                    openModal('retur-modal');
                });
            });

            function performSearch() {
                let no = 1;
                let filter = document.getElementById('search').value.toLowerCase();
                document.querySelectorAll('tbody tr').forEach(row => {
                    if (row.textContent.toLowerCase().includes(filter)) {
                        row.style.display = '';
                        const numCell = row.querySelector('.row-number');
                        if (numCell) numCell.textContent = no++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Event Tombol Refresh
            document.getElementById('btnRefresh').onclick = function() {
                document.getElementById('search').value = '';
                performSearch();
                const icon = this.querySelector('i');
                icon.classList.add('ti-spin');
                setTimeout(() => icon.classList.remove('ti-spin'), 500);
            };
        });
    </script>
    @endpush
</x-app-layout>
