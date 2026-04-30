<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Edit Barang</h2>
                    <p class="text-sm text-gray-500 mt-1">Ubah data inventaris lab - Prodi: <span
                            class="font-semibold text-blue-600">{{ auth()->user()->prodi->nama_prodi ?? '-' }}</span>
                    </p>
                </div>
                <a href="{{ route('barang.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden relative">
                @csrf
                @method('PUT')

                @error('stok')
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 mx-8 mt-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ $message }}</p>
                        </div>
                    </div>
                </div>
                @enderror

                <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3 bg-white">
                    <div class="p-2 bg-yellow-50 rounded-lg">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Ubah Data Barang</h3>
                </div>

                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori <span
                                    class="text-red-500">*</span></label>
                            <select name="kategori_id" required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi <span
                                    class="text-red-500">*</span></label>
                            <select name="kondisi_id" required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                                <option value="">-- Pilih Kondisi --</option>
                                @foreach($kondisis as $kondisi)
                                <option value="{{ $kondisi->id }}"
                                    {{ old('kondisi_id', $barang->kondisi_id) == $kondisi->id ? 'selected' : '' }}>
                                    {{ $kondisi->nama_kondisi }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ruang <span
                                    class="text-red-500">*</span></label>
                            <select name="ruang_id" required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                                <option value="">-- Pilih Ruang --</option>
                                @foreach($ruangs as $ruang)
                                <option value="{{ $ruang->id }}"
                                    {{ old('ruang_id', $barang->ruang_id) == $ruang->id ? 'selected' : '' }}>
                                    {{ $ruang->nama_ruang }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                                required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Barang <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}"
                                required readonly
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                            @error('kode_barang') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Merk</label>
                            <input type="text" name="merk" value="{{ old('merk', $barang->merk) }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                        </div>

                        <!-- Kolom Kiri: Gabungan Jumlah & Satuan -->
                        <div class="flex gap-4">
                            <div class="w-1/3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah <span
                                        class="text-red-500">*</span></label>
                                <!-- Tambahkan $barang->stok agar jumlah lamanya muncul -->
                                <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}" required
                                    min="0"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                    placeholder="0">
                            </div>
                            <div class="w-2/3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Satuan <span
                                        class="text-red-500">*</span></label>
                                <select name="satuan" required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                                    <option value="">-- Pilih Satuan --</option>
                                    <!-- Tambahkan $barang->satuan di setiap opsi agar satuan lamanya otomatis terpilih -->
                                    <option value="Unit"
                                        {{ old('satuan', $barang->satuan) == 'Unit' ? 'selected' : '' }}>Unit
                                        (Alat/Mesin)</option>
                                    <option value="Pcs" {{ old('satuan', $barang->satuan) == 'Pcs' ? 'selected' : '' }}>
                                        Pcs (Barang Satuan)</option>
                                    <option value="Set" {{ old('satuan', $barang->satuan) == 'Set' ? 'selected' : '' }}>
                                        Set (Satu Paket)</option>
                                    <option value="Box" {{ old('satuan', $barang->satuan) == 'Box' ? 'selected' : '' }}>
                                        Box / Kotak</option>
                                    <option value="Roll"
                                        {{ old('satuan', $barang->satuan) == 'Roll' ? 'selected' : '' }}>Roll
                                        (Kabel/Timah)</option>
                                    <option value="Rim" {{ old('satuan', $barang->satuan) == 'Rim' ? 'selected' : '' }}>
                                        Rim (Kertas)</option>
                                    <option value="Botol"
                                        {{ old('satuan', $barang->satuan) == 'Botol' ? 'selected' : '' }}>Botol
                                        (Cairan/Tinta)</option>
                                    <option value="Pack"
                                        {{ old('satuan', $barang->satuan) == 'Pack' ? 'selected' : '' }}>Pack (Bungkus)
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Tahun / Sumber Perolehan -->

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun / Sumber Perolehan</label>
                            <input type="text" name="tahun_pembuatan"
                                value="{{ old('tahun_pembuatan', $barang->tahun_pembuatan) }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                placeholder="Contoh: BOS 2019 atau 2024">
                            <p class="mt-1 text-xs text-gray-500 italic">*Bisa diisi tahun atau keterangan
                                anggaran</p>
                        </div>
                    </div>

                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    </div>

                    <div class="mt-2 flex gap-6 items-start">
                        <div class="w-32 flex-shrink-0">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                            <div
                                class="w-full aspect-square bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                @if($barang->foto)
                                <img src="{{ asset('storage/' . $barang->foto) }}" alt="Foto Lama"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Foto Barang
                                (Opsional)</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none shadow-sm file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                                type="file" name="foto" accept="image/*">
                            <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah foto. Format:
                                PNG, JPG, JPEG (Max. 2MB)</p>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-4 bg-gray-50/80 border-t border-gray-100 flex justify-end items-center gap-4">
                    <a href="{{ route('barang.index') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Update Barang
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>