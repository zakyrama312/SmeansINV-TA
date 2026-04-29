<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Barang</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap aset dan inventaris laboratorium</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('barang.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-50 shadow-sm transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <a href="{{ route('barang.barcode', $barang->kode_barang) }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-purple-700 shadow-sm transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                            </path>
                        </svg>
                        Cetak Barcode
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex flex-col md:flex-row">

                    <div
                        class="w-full md:w-2/5 bg-gray-50 border-r border-gray-100 p-8 flex flex-col items-center justify-center relative">
                        <div
                            class="absolute top-6 left-6 bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md z-10">
                            Stok Tersedia: {{ $barang->jumlah_tersedia }}
                        </div>
                        @if ($barang->tahun_pembuatan)
                        <div
                            class="absolute top-6 right-6 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md z-10">
                            Tahun Pengadaan: {{ $barang->tahun_pembuatan }}
                        </div>
                        @endif

                        <div
                            class="w-64 h-64 rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-200 flex items-center justify-center group">
                            @if($barang->foto)
                            <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            @else
                            <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 mt-4 text-center">Ditambahkan pada: <br>
                            {{ $barang->created_at->translatedFormat('l, d F Y') }}
                        </p>
                    </div>


                    <div class="w-full md:w-3/5 p-8">

                        <div class="mb-6 pb-6 border-b border-gray-100">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="bg-gray-100 text-gray-600 text-xs font-bold px-2.5 py-1 rounded-md">{{ $barang->kode_barang }}</span>
                                <span
                                    class="bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-md">{{ $barang->kondisi->nama_kondisi ?? 'Tidak diketahui' }}</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $barang->nama_barang }}</h3>
                            <p class="text-base text-gray-500 mt-1">{{ $barang->merk ?? 'Tanpa Merk' }}</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8 mb-8">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 mb-1">Kategori Barang</p>
                                <p class="text-base font-bold text-gray-900">
                                    {{ $barang->kategori->nama_kategori ?? '-' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-gray-500 mb-1">Ruang / Lokasi Lab</p>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-blue-500 mr-1.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <p class="text-base font-bold text-gray-900">{{ $barang->ruang->nama_ruang ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-gray-500 mb-1">Total Stok Keseluruhan</p>
                                <p class="text-base font-bold text-gray-900">{{ $barang->stok }} Unit</p>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-gray-500 mb-1">Stok Sedang Keluar / Dipinjam</p>
                                <p class="text-base font-bold text-red-600">
                                    {{ $barang->stok - $barang->jumlah_tersedia }} Unit
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-sm font-semibold text-gray-500 mb-1">Spesifikasi Detail</p>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <p class="text-sm text-gray-800 leading-relaxed">
                                        {{ $barang->spesifikasi ?? 'Tidak ada spesifikasi khusus.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-sm font-semibold text-gray-500 mb-1">Keterangan Tambahan</p>
                                <p class="text-sm text-gray-800">{{ $barang->keterangan ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 border-t border-gray-100">
                            <a href="{{ route('barang.edit', $barang->id) }}"
                                class="inline-flex items-center px-6 py-2.5 bg-yellow-400 hover:bg-yellow-500 text-yellow-900 font-bold rounded-xl transition-colors shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                Edit Data Barang
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>