<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $ruang->nama_ruang }}</h2>

                    <div class="flex gap-4 items-center">
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">Search:</span>
                            <input type="text"
                                class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-blue-500 focus:border-blue-500 w-48">
                        </div>

                        <a href="{{ route('laporan.ruang.cetak', Str::slug($ruang->nama_ruang)) }}" target="_blank"
                            class="inline-flex items-center justify-center p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors shadow-sm"
                            title="Cetak Kartu Inventaris Ruangan">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 font-bold bg-white border-b-2 border-gray-200">
                            <tr>
                                <th class="py-4 px-4 text-center w-12">No</th>
                                <th class="py-4 px-4">Nama Barang</th>
                                <th class="py-4 px-4">Merk</th>
                                <th class="py-4 px-4 text-center">Jumlah</th>
                                <th class="py-4 px-4 text-center">Kondisi</th>
                                <th class="py-4 px-4 text-center">Ruang</th>
                                <th class="py-4 px-4">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($barangs as $index => $item)
                            <tr
                                class="hover:bg-gray-50 transition-colors {{ $index % 2 == 0 ? 'bg-gray-50/50' : 'bg-white' }}">
                                <td class="py-4 px-4 text-center">{{ $barangs->firstItem() + $index }}</td>
                                <td class="py-4 px-4 font-medium text-gray-900">{{ $item->nama_barang }}</td>
                                <td class="py-4 px-4">{{ $item->merk ?? '-' }}</td>
                                <td class="py-4 px-4 text-center font-bold text-gray-900">{{ $item->stok }}
                                    {{ $item->satuan }}
                                </td>
                                <td class="py-4 px-4 text-center">{{ $item->kondisi->nama_kondisi ?? '-' }}</td>
                                <td class="py-4 px-4 text-center">{{ $ruang->nama_ruang }}</td>
                                <td class="py-4 px-4">{{ $item->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-500">Belum ada barang di ruangan ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $barangs->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>