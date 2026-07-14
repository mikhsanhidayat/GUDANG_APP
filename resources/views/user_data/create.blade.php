<x-app-layout>
    <div class="w-full flex justify-center">
        <div class="w-full max-w-3xl">
            <div class="horizon-card w-full p-8 mt-5">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
                    <h5 class="text-2xl font-bold text-navy-700">Tambah User Baru</h5>
                </div>

                <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0"
                                placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Email (Username)</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0"
                                placeholder="contoh@gmail.com" required>
                            @error('email')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Password</label>
                            <input type="text" name="password" id="password" readonly
                                class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0 bg-gray-50 text-gray-500"
                                placeholder="Akan otomatis terisi sama dengan email" required>
                            <p class="mt-1 text-xs text-gray-400">*Password default disamakan dengan email untuk kemudahan admin.</p>
                            @error('password')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full">
                            <label class="mb-2 block text-sm font-bold text-navy-700">Role / Hak Akses</label>
                            <select name="role" id="role" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                                <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                            </select>
                            @error('role')
                                <div class="mt-1 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('users.index') }}" class="rounded-xl bg-gray-100 px-6 py-3 text-sm font-medium text-navy-700 transition hover:bg-gray-200">
                            Batal
                        </a>
                        <button type="submit" class="rounded-xl bg-brand-500 px-6 py-3 text-sm font-medium text-white transition hover:bg-brand-600 shadow-md shadow-brand-500/30">
                            Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('page-js')
    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        emailInput.addEventListener('input', function() {
            passwordInput.value = this.value;
        });
    </script>
    @endpush
</x-app-layout>