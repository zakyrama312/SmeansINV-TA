<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Tambah Barang</h2>
                    <p class="text-sm text-gray-500 mt-1">Form input data barang baru - Prodi: <span
                            class="font-semibold text-blue-600">{{ auth()->user()->prodi->nama_prodi ?? 'Belum ada prodi' }}</span>
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

            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden relative">
                @csrf

                <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3 bg-white">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Informasi Barang</h3>
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
                                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi <span
                                    class="text-red-500">*</span></label>
                            <select name="kondisi_id" required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                                <option value="">-- Pilih Kondisi --</option>
                                @foreach($kondisis as $kondisi)
                                <option value="{{ $kondisi->id }}"
                                    {{ old('kondisi_id') == $kondisi->id ? 'selected' : '' }}>
                                    {{ $kondisi->nama_kondisi }}</option>
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
                                <option value="{{ $ruang->id }}" {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}>
                                    {{ $ruang->nama_ruang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                placeholder="Contoh: Laptop Dell Latitude">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Barang <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                placeholder="Contoh: LPT-001">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Merk</label>
                            <input type="text" name="merk" value="{{ old('merk') }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                placeholder="Contoh: Dell">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Total <span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="stok" value="{{ old('stok') }}" required min="0"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                placeholder="0">
                        </div>

                        <div></div>
                    </div>

                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                            placeholder="Deskripsi detail barang...">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Barang</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none shadow-sm file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
                            type="file" name="foto" accept="image/*">
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG (Max. 2MB)</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Barang
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
