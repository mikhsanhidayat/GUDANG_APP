<x-app-layout>
    <div class="bg-[#2A446C] min-h-screen pl-56 pt-44 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-2xl p-8">

                <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
                    Tambah Produk Baru
                </h1>

                <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- KODE PRODUK (Readonly) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Produk</label>
                        <input type="text" readonly name="kode_produk" id="kode_produk"
                            value="{{ old('kode_produk') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 shadow-sm sm:text-sm"
                            required>
                        @error('kode_produk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NAMA PRODUK --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk"
                            value="{{ old('nama_produk') }}"
                            placeholder="Contoh: Katun Jepang"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                        @error('nama_produk')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- WARNA --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Warna</label>
                        <input type="text" name="warna" id="warna"
                            value="{{ old('warna') }}"
                            placeholder="Contoh: Merah"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                        @error('warna')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- LOGO (Dropdown berdasarkan Enum) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pilih Logo</label>
                        <select name="logo" id="logo" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                            <option value="">-- Pilih Logo --</option>
                            <option value="IBI" {{ old('logo') == 'IBI' ? 'selected' : '' }}>IBI</option>
                            <option value="IDI" {{ old('logo') == 'IDI' ? 'selected' : '' }}>IDI</option>
                        </select>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- STOK --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Stok Tersedia</label>
                        <input type="number" name="stok_tersedia"
                            value="{{ old('stok_tersedia', 0) }}"
                            min="0"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                        @error('stok_tersedia')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- TOMBOL --}}
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('products.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-200">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-200">
                            Simpan Produk
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPT GENERATE KODE OTOMATIS --}}
    <script>
        function generateKodeProduk() {
            const nama = document.getElementById('nama_produk').value.trim();
            const warna = document.getElementById('warna').value.trim();
            const logo = document.getElementById('logo').value;

            // Pastikan panjang nama minimal 4 karakter agar huruf ke-3 dan ke-4 tersedia
            if (nama.length >= 4 && warna.length >= 1 && logo !== "") {
                
                const h1 = nama.substring(0, 1);      // Huruf ke-1
                const h3 = nama.substring(2, 3);      // Huruf ke-3
                const h4 = nama.substring(3, 4);      // Huruf ke-4
                const hLast = nama.slice(-1);         // Huruf Terakhir
                
                const kodeWarna = warna.substring(0, 1); // Huruf ke-1 Warna
                const kodeLogo = (logo === 'IBI') ? '01' : '02';

                const hasil = `${h1}${h3}${h4}${hLast}-${kodeWarna}-${kodeLogo}`;
                document.getElementById('kode_produk').value = hasil.toUpperCase();
            } else {
                document.getElementById('kode_produk').value = '';
            }
        }

        // Jalankan fungsi setiap kali ada input
        document.getElementById('nama_produk').addEventListener('input', generateKodeProduk);
        document.getElementById('warna').addEventListener('input', generateKodeProduk);
        document.getElementById('logo').addEventListener('change', generateKodeProduk);
    </script>
</x-app-layout>