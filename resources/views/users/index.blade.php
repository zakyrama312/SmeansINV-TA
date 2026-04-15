<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Kelola Pengguna</h2>
                    <p class="text-sm text-gray-500 mt-1">Manajemen akun administrator dan teknisi lab</p>
                </div>
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-900 rounded-lg font-semibold text-sm text-white hover:bg-gray-800 transition shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                    Tambah Pengguna
                </a>
            </div>

            @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
            @endif
            @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm flex items-center">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-red-700 font-medium">{{ session('error') }}</p>
            </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="mb-6 relative w-full md:w-80">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchInput"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Cari nama atau email pengguna...">
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="py-4 px-4 font-semibold text-center w-12">No</th>
                                <th class="py-4 px-4 font-semibold">Pengguna</th>
                                <th class="py-4 px-4 font-semibold">Email & Kontak</th>
                                <th class="py-4 px-4 font-semibold text-center">Prodi / Lab</th>
                                <th class="py-4 px-4 font-semibold text-center">Status Akses</th>
                                <th class="py-4 px-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($users as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors row-user">
                                <td class="py-4 px-4 text-center font-medium">{{ $loop->iteration }}</td>

                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold uppercase">
                                            {{ substr($item->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 data-name">{{ $item->name }}</div>
                                            @if($item->id === auth()->id())
                                            <span
                                                class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-bold">Anda
                                                Saat Ini</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-4 data-email">{{ $item->email }}</td>

                                <td class="py-4 px-4 text-center">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        {{ $item->prodi->nama_prodi ?? 'Global' }}
                                    </span>
                                </td>

                                <td class="py-4 px-4 text-center">
                                    <span class="inline-flex items-center text-xs font-bold text-green-600">
                                        <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span> Aktif
                                    </span>
                                </td>

                                <td class="py-4 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('users.edit', $item->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-bold rounded-md transition-colors shadow-sm">
                                            Edit
                                        </a>
                                        @if($item->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus pengguna ini?');"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-md transition-colors shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-500">Belum ada data pengguna.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('.row-user');

        searchInput.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();
            rows.forEach(row => {
                const name = row.querySelector('.data-name').textContent.toLowerCase();
                const email = row.querySelector('.data-email').textContent.toLowerCase();
                row.style.display = (name.includes(term) || email.includes(term)) ? '' : 'none';
            });
        });
    });
    </script>
</x-app-layout>
