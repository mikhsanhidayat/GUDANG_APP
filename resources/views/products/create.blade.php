<x-app-layout>
    <div class="w-full flex justify-center">
        <div class="w-full max-w-3xl">
            <div class="horizon-card w-full p-8 mt-5">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
                    <h5 class="text-2xl font-bold text-navy-700">Tambah Produk Baru</h5>
                </div>

                <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Kode Produk</label>
                            <input type="text" name="kode_produk" id="kode_produk" value="{{ old('kode_produk') }}"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0 bg-gray-50"
                                placeholder="Auto Generate" required>
                            <p class="mt-1 text-xs text-gray-400">*Bisa diedit manual jika tidak ingin auto-generate</p>
                            @error('kode_produk')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0"
                                placeholder="Contoh: Jas Hujan Premium" required>
                            @error('nama_produk')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Warna Produk</label>
                            <input type="text" name="warna" value="{{ old('warna') }}"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0"
                                placeholder="Contoh: Hitam, Biru" required>
                            @error('warna')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Jenis Logo</label>
                            <select name="logo" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                                <option value="IBI" {{ old('logo') == 'IBI' ? 'selected' : '' }}>IBI</option>
                                <option value="IDI" {{ old('logo') == 'IDI' ? 'selected' : '' }}>IDI</option>
                            </select>
                            @error('logo')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Stok Awal</label>
                            <input type="number" name="stok_tersedia" value="{{ old('stok_tersedia', 0) }}" min="0"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                            @error('stok_tersedia')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('products.index') }}" class="rounded-xl bg-gray-100 px-6 py-3 text-sm font-medium text-navy-700 transition hover:bg-gray-200">
                            Batal
                        </a>
                        <button type="submit" class="rounded-xl bg-brand-500 px-6 py-3 text-sm font-medium text-white transition hover:bg-brand-600 shadow-md shadow-brand-500/30">
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('page-js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputNama = document.getElementById('nama_produk');
            const inputKode = document.getElementById('kode_produk');
            
            // Auto generate kode produk saat nama produk diketik
            inputNama.addEventListener('input', function() {
                // Jangan override jika user sudah mengedit manual (opsional, tp di case ini kita sll override klo diubah dr nama)
                const nama = this.value;
                if (nama.length > 0) {
                    const singkatan = nama.split(' ').map(word => word.charAt(0)).join('').toUpperCase();
                    const randomNum = Math.floor(100 + Math.random() * 900); // 3 digit angka random
                    inputKode.value = 'PRD-' + singkatan + '-' + randomNum;
                } else {
                    inputKode.value = '';
                }
            });
        });
    </script>
    @endpush
</x-app-layout>