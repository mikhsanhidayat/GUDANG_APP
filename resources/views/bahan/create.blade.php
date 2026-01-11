<x-app-layout>

<div class="bg-[#2A446C] min-h-screen pl-56 pt-44 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-2xl p-8">

            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
                Tambah Bahan Baru
            </h1>

            <form action="{{ route('bahan.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- KODE BAHAN --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Kode Bahan
                    </label>
                    <input type="text" readonly name="kode_bahan" id="kode_bahan"
                        value="{{ old('kode_bahan') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                    @error('kode_bahan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NAMA BAHAN --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Nama Bahan
                    </label>
                    <input type="text" name="nama_bahan" id="nama_bahan"
                        value="{{ old('nama_bahan') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                    @error('nama_bahan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- WARNA --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Warna
                    </label>
                    <input type="text" name="warna" id="warna"
                        value="{{ old('warna') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                    @error('warna')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- STOK --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Stok Tersedia
                    </label>
                    <input type="number" name="stok_tersedia"
                        value="{{ old('stok_tersedia', 0) }}"
                        min="0"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                    @error('stok_tersedia')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- SUPPLIER --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Nama Supplier
                    </label>
                    <input type="text" name="supplier"
                        value="{{ old('supplier') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                               focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                    @error('supplier')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TOMBOL --}}
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('bahan.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-lg">
                        Batal
                    </a>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                        Simpan Bahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- ================= SCRIPT KODE BAHAN OTOMATIS ================= --}}
<script>
    function generateKodeBahan() {
        const nama = document.getElementById('nama_bahan').value.trim();
        const warna = document.getElementById('warna').value.trim();

        if (nama.length < 3 || warna.length < 1) return;

        const kodeNama = nama.substring(0, 3).toUpperCase();
        const kodeWarna = warna.charAt(0).toUpperCase();

        document.getElementById('kode_bahan').value = `${kodeNama}-${kodeWarna}`;
    }

    document.getElementById('nama_bahan').addEventListener('input', generateKodeBahan);
    document.getElementById('warna').addEventListener('input', generateKodeBahan);
</script>

</x-app-layout>



