<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Kelola Barang</h2>
                    <p class="text-sm text-gray-500 mt-1">Manajemen data barang inventaris</p>
                </div>
                <a href="{{ route('barang.create') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-blue-600 rounded-lg font-semibold text-sm text-white hover:bg-blue-700 transition shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Barang
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="searchInput"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                            placeholder="Cari nama barang atau kode...">
                    </div>


                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase border-b border-gray-200">
                            <tr>
                                <th scope="col" class="py-4 pr-4 font-semibold text-center w-12">No</th>
                                <th scope="col" class="py-4 px-4 font-semibold">Tanggal Masuk</th>
                                <th scope="col" class="py-4 px-4 font-semibold">Barang</th>
                                <th scope="col" class="py-4 px-4 font-semibold text-center">Kategori</th>
                                <th scope="col" class="py-4 px-4 font-semibold text-center">Kondisi</th>
                                <th scope="col" class="py-4 px-4 font-semibold text-center">Jumlah</th>
                                <th scope="col" class="py-4 px-4 font-semibold text-center">Stok Keluar</th>
                                <th scope="col" class="py-4 px-4 font-semibold text-center">Ruang</th>
                                <th scope="col" class="py-4 px-4 font-semibold text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100" id="tableBody">
                            @forelse($barangs as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors barang-row">
                                <td class="py-4 pr-4 text-center font-medium">{{ $loop->iteration }}</td>
                                <td class="py-4 px-4 whitespace-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-blue-50 flex items-center justify-center border border-gray-100">
                                            @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                                            @else
                                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 barang-name">{{ $item->nama_barang }}</div>
                                            <div class="text-xs text-gray-500 barang-kode">{{ $item->kode_barang }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                        {{ $item->kategori->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        {{ $item->kondisi->nama_kondisi ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <div class="text-gray-900"><span class="font-bold">{{ $item->jumlah_tersedia }}</span> / {{ $item->stok }}</div>
                                    @if($item->jumlah_tersedia < 5)
                                        <div class="text-xs text-orange-500 font-semibold mt-0.5">Sedikit
                </div>
                @endif
                </td>
                <td class="py-4 px-4 text-center">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                        {{ $item->stok - $item->jumlah_tersedia }}
                    </span>
                </td>
                <td class="py-4 px-4 text-center">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                        {{ $item->ruang->nama_ruang ?? '-' }}
                    </span>
                </td>

                <td class="py-4 px-4 text-center">
                    <div class="flex items-center justify-center gap-1.5">

                        <a href="{{ route('barang.show', $item->kode_barang) }}" title="Detail Barang" class="p-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>

                        <a href="{{ route('barang.barcode', $item->kode_barang) }}" target="_blank" title="Cetak Barcode" class="p-2 bg-purple-50 hover:bg-purple-100 text-purple-600 rounded-lg transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                        </a>

                        <a href="{{ route('barang.edit', $item->id) }}" title="Edit Barang" class="p-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </a>

                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus barang ini?');" title="Hapus Barang" class="p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>

                    </div>
                </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="py-12 text-center text-gray-500">
                        Belum ada data barang di laboratorium ini.
                    </td>
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
            const rows = document.querySelectorAll('.barang-row');

            searchInput.addEventListener('keyup', function(e) {
                const term = e.target.value.toLowerCase();

                rows.forEach(row => {
                    const namaBarang = row.querySelector('.barang-name').textContent.toLowerCase();
                    const kodeBarang = row.querySelector('.barang-kode').textContent.toLowerCase();

                    if (namaBarang.includes(term) || kodeBarang.includes(term)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</x-app-layout>