<x-app-layout>
    <div class="bg-[#2A446C] min-h-screen pl-72 pt-40">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full">

                <div class="flex justify-start text-2xl mb-6">
                    <h1 class="text-white text-3xl font-bold">Daftar User</h1>
                </div>

                @can('create', $item = new App\Models\User())
                    <div class="flex justify-start text-2xl mb-6">
                        <a href="{{ route('users.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-bold py-2 px-4 shadow-lg">
                            Tambah User
                        </a>
                    </div>
                @endcan

                <div class="mb-8 w-1/3">
                    <input type="text" id="search-user" placeholder="Cari User..."
                        class="w-full p-3 rounded-lg bg-[#FFFFFF33] text-white border border-gray-600
                               focus:ring-2 focus:ring-bl ue-500 placeholder-gray-400">
                </div>

                <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-2 text-center">No</th>
                                <th class="px-6 py-2 text-center">Name</th>
                                <th class="px-6 py-2 text-center">Email</th>
                                <th class="px-6 py-2 text-center">Role</th>
                                <th class="px-6 py-2 text-center">Created At</th>

                                <th class="px-6 py-2 text-center">Aksi</th>


                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach ($users as $user)
                                {{-- Menambahkan border-b dan hover effect untuk konsistensi --}}
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    {{-- Mengubah py-3 menjadi py-4 untuk space yang lebih lega --}}
                                    <td class="text-center py-4 row-number-user">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="text-center py-4">{{ $user->name }}</td>
                                    <td class="text-center py-4">{{ $user->email }}</td>
                                    <td class="text-center py-4">{{ ucfirst($user->role ?? 'pegawai') }}</td>
                                    <td class="text-center py-4">{{ $user->created_at->format('d-m-Y') }}</td>

                                    @can('lihat', $user)
                                        <td class="text-center py-4">
                                            {{-- TOMBOL EDIT --}}
                                            <button
                                                class="edit-user-btn bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-[2px] rounded-full"
                                                data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}">
                                                Edit
                                            </button>

                                            {{-- TOMBOL HAPUS --}}
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button onclick="return confirm('Yakin hapus user ini?')"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-[2px] rounded-full">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 px-4 pr-14 pb-4 pagination-custom">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MODAL EDIT USER ================= --}}
    <div id="edit-user-modal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Edit Data User</h3>

            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Nama User</label>
                    <input type="text" name="name" id="modal_user_name"
                        class="w-full border rounded p-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="modal_user_email"
                        class="w-full border rounded p-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" id="closeUserModal"
                        class="px-4 py-2 bg-gray-400 rounded text-white hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 rounded text-white hover:bg-blue-700">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT SEARCH DENGAN RESET NOMOR --}}
    <script>
        document.getElementById('search-user').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let visibleCount = 1; // Mulai hitung nomor dari 1

            document.querySelectorAll('tbody tr').forEach(row => {
                let textMatch = row.textContent.toLowerCase().includes(filter);
                if (textMatch) {
                    row.style.display = '';
                    // Update nomor hanya pada baris yang tampil
                    let numberCell = row.querySelector('.row-number-user');
                    if (numberCell) {
                        numberCell.textContent = visibleCount++;
                    }
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

    {{-- SCRIPT MODAL EDIT USER --}}
    <script>
        const editUserModal = document.getElementById('edit-user-modal');
        const editUserButtons = document.querySelectorAll('.edit-user-btn');
        const closeUserModal = document.getElementById('closeUserModal');
        const editUserForm = document.getElementById('editUserForm');

        editUserButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('modal_user_name').value = btn.dataset.name;
                document.getElementById('modal_user_email').value = btn.dataset
                .email; // Perbaikan ID disini
                editUserForm.action = `/users/${btn.dataset.id}`;
                editUserModal.classList.remove('hidden');
            });
        });

        closeUserModal.addEventListener('click', () => {
            editUserModal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target == editUserModal) {
                editUserModal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
