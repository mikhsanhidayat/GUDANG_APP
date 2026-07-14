<x-app-layout>
    <div class="w-full">
        <div class="w-full">
            @can('create', $item = new App\Models\User())
                <div class="mb-4">
                    <button class="create-btn inline-flex items-center justify-center rounded-xl bg-brand-500 px-5 py-3 text-base font-medium text-white transition duration-200 hover:bg-brand-600 active:bg-brand-700">
                        <i class="ti ti-plus mr-2"></i> Tambah User
                    </button>
                </div>
            @endcan

            <div class="horizon-card w-full p-4 overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between pb-4 border-b border-gray-100 mb-4 gap-4">
                    <h5 class="text-xl font-bold text-navy-700">Data User</h5>
                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <div class="flex h-10 items-center rounded-full bg-lightPrimary text-navy-700 w-full md:w-[250px]">
                            <p class="pl-3 pr-2 text-xl">
                                <i class="ti ti-search h-4 w-4 text-gray-400"></i>
                            </p>
                            <input type="text" id="search-user" placeholder="Cari User..." class="block h-full w-full rounded-full bg-lightPrimary text-sm font-medium text-navy-700 outline-none placeholder:!text-gray-400 border-none focus:ring-0" />
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 text-left text-sm font-bold tracking-wide text-gray-600 uppercase">
                                <th class="pb-3 px-4 text-center">No</th>
                                <th class="pb-3 px-4 text-center">Name</th>
                                <th class="pb-3 px-4 text-center">Email</th>
                                <th class="pb-3 px-4 text-center">Role</th>
                                <th class="pb-3 px-4 text-center">Created At</th>
                                <th class="pb-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                                    <td class="py-3 px-4 text-center text-sm text-navy-700 row-number-user">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                    <td class="py-3 px-4 text-center text-sm font-bold text-navy-700">{{ $user->name }}</td>
                                    <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $user->email }}</td>
                                    <td class="py-3 px-4 text-center text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold 
                                            {{ $user->role == 'admin' ? 'bg-blue-100 text-blue-700' : ($user->role == 'pemilik' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700') }}">
                                            {{ ucfirst($user->role ?? 'pegawai') }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center text-sm text-gray-600">{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td class="py-3 px-4 text-center flex flex-wrap justify-center gap-2">
                                        @can('lihat', $user)
                                            <button class="edit-user-btn inline-flex items-center justify-center rounded-lg bg-horizonGreen-500 px-3 py-1.5 text-xs font-medium text-white hover:bg-green-600"
                                                data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block m-0">
                                                @csrf @method('DELETE')
                                                <button onclick="return confirm('Yakin hapus user ini?')" class="inline-flex items-center justify-center rounded-lg bg-gray-800 px-3 py-1.5 text-xs font-medium text-white hover:bg-gray-900">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE USER --}}
    <div id="create-modal" class="fixed inset-0 z-[100] hidden items-center justify-center overflow-auto bg-black/40 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-lg rounded-[20px] bg-white shadow-3xl">
            <form id="createForm" action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="flex items-center justify-between border-b border-gray-100 p-5">
                    <h5 class="text-xl font-bold text-navy-700">Tambah User Baru</h5>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600"><i class="ti ti-x text-xl"></i></button>
                </div>
                <div class="p-5 max-h-[70vh] overflow-y-auto">
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Nama Lengkap</label>
                        <input type="text" name="name" id="create_name" value="{{ old('name') }}"
                            class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Email (Username)</label>
                        <input type="email" name="email" id="create_email" value="{{ old('email') }}"
                            class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0"
                            placeholder="contoh@gmail.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Password</label>
                        <input type="text" name="password" id="create_password" readonly
                            class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0 bg-gray-50 text-gray-500"
                            placeholder="Akan otomatis terisi sama dengan email" required>
                        <p class="mt-1 text-xs text-gray-400">*Password default disamakan dengan email</p>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Role / Hak Akses</label>
                        <select name="role" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                            <option value="pegawai" {{ old('role') == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pemilik" {{ old('role') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end border-t border-gray-100 p-5 gap-3">
                    <button type="button" class="close-modal rounded-xl bg-gray-100 px-5 py-2.5 text-sm font-medium text-navy-700 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="rounded-xl bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-md shadow-brand-500/30">Simpan User</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT USER --}}
    <div id="edit-user-modal" class="fixed inset-0 z-[100] hidden items-center justify-center overflow-auto bg-black/40 backdrop-blur-sm p-4">
        <div class="relative w-full max-w-lg rounded-[20px] bg-white shadow-3xl">
            <form id="editUserForm" method="POST">
                @csrf @method('PUT')
                <div class="flex items-center justify-between border-b border-gray-100 p-5">
                    <h5 class="text-xl font-bold text-navy-700">Edit Data User</h5>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600"><i class="ti ti-x text-xl"></i></button>
                </div>
                <div class="p-5">
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Nama User</label>
                        <input type="text" name="name" id="modal_user_name" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-bold text-navy-700">Email Address</label>
                        <input type="email" name="email" id="modal_user_email" class="w-full rounded-xl border border-gray-200 p-3 text-sm outline-none focus:border-brand-500 focus:ring-0" required>
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
        document.addEventListener('DOMContentLoaded', function() {
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

            document.getElementById('search-user').addEventListener('keyup', function() {
                let filter = this.value.toLowerCase();
                let visibleCount = 1;

                document.querySelectorAll('tbody tr').forEach(row => {
                    let textMatch = row.textContent.toLowerCase().includes(filter);
                    if (textMatch) {
                        row.style.display = '';
                        let numberCell = row.querySelector('.row-number-user');
                        if (numberCell) numberCell.textContent = visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            const editUserForm = document.getElementById('editUserForm');

            document.querySelectorAll('.edit-user-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('modal_user_name').value = btn.dataset.name;
                    document.getElementById('modal_user_email').value = btn.dataset.email;
                    editUserForm.action = `/users/${btn.dataset.id}`;
                    openModal('edit-user-modal');
                });
            });

            // ===== CREATE MODAL =====
            document.querySelectorAll('.create-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    openModal('create-modal');
                });
            });

            const emailInput = document.getElementById('create_email');
            const passwordInput = document.getElementById('create_password');

            if (emailInput && passwordInput) {
                emailInput.addEventListener('input', function() {
                    passwordInput.value = this.value;
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
