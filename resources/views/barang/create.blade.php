<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
    /* Modifikasi style bawaan Select2 agar matching dengan Tailwind */
    .select2-container .select2-selection--single {
        height: 42px !important;
        border-color: #d1d5db !important;
        border-radius: 0.5rem !important;
        display: flex !important;
        align-items: center !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #111827 !important;
        line-height: 42px !important;
        padding-left: 12px !important;
    }
    </style>

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
                    class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-900 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition.opacity
                class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 w-full flex justify-between items-center">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    <button @click="show = false" class="text-green-600 hover:text-green-800 font-bold ml-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            @endif

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
                            <select name="kategori_id" required class="select2-kategori w-full">
                                <option value="">-- Ketik/Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi <span
                                    class="text-red-500">*</span></label>
                            <select name="kondisi_id" required class="select2-kondisi w-full">
                                <option value="">-- Ketik/Pilih Kondisi --</option>
                                @foreach($kondisis as $kondisi)
                                <option value="{{ $kondisi->id }}"
                                    {{ old('kondisi_id') == $kondisi->id ? 'selected' : '' }}>
                                    {{ $kondisi->nama_kondisi }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ruang <span
                                    class="text-red-500">*</span></label>
                            <select name="ruang_id" required class="select2-ruang w-full">
                                <option value="">-- Ketik/Pilih Ruang --</option>
                                @foreach($ruangs as $ruang)
                                <option value="{{ $ruang->id }}" {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}>
                                    {{ $ruang->nama_ruang }}
                                </option>
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
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Barang <span
                                    class="text-xs text-blue-600 font-normal ml-1">(Otomatis)</span></label>
                            <input type="text" name="kode_barang" value="{{ $kodeBarangOtomatis }}" readonly
                                class="bg-gray-100 border border-gray-300 text-gray-700 font-bold text-sm rounded-xl block w-full p-3 cursor-not-allowed"
                                title="Kode dibuat otomatis oleh sistem">
                            <p class="text-xs text-gray-500 mt-1.5 italic">Format: PRODI-TAHUNBULAN-URUTAN</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Merk</label>
                            <input type="text" name="merk" value="{{ old('merk') }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                placeholder="Contoh: Dell">
                        </div>

                        <!-- Kolom Kiri: Gabungan Jumlah & Satuan -->
                        <div class="flex gap-4">
                            <div class="w-1/3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah <span
                                        class="text-red-500">*</span></label>
                                <input type="number" name="stok" value="{{ old('stok') }}" required min="0"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                    placeholder="0">
                            </div>
                            <div class="w-2/3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Satuan <span
                                        class="text-red-500">*</span></label>
                                <select name="satuan" required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm">
                                    <option value="">-- Pilih Satuan --</option>
                                    <option value="Unit" {{ old('satuan') == 'Unit' ? 'selected' : '' }}>Unit
                                        (Alat/Mesin)</option>
                                    <option value="Pcs" {{ old('satuan') == 'Pcs' ? 'selected' : '' }}>Pcs (Barang
                                        Satuan)</option>
                                    <option value="Set" {{ old('satuan') == 'Set' ? 'selected' : '' }}>Set (Satu Paket)
                                    </option>
                                    <option value="Box" {{ old('satuan') == 'Box' ? 'selected' : '' }}>Box / Kotak
                                    </option>
                                    <option value="Roll" {{ old('satuan') == 'Roll' ? 'selected' : '' }}>Roll
                                        (Kabel/Timah)</option>
                                    <option value="Rim" {{ old('satuan') == 'Rim' ? 'selected' : '' }}>Rim (Kertas)
                                    </option>
                                    <option value="Botol" {{ old('satuan') == 'Botol' ? 'selected' : '' }}>Botol
                                        (Cairan/Tinta)</option>
                                    <option value="Pack" {{ old('satuan') == 'Pack' ? 'selected' : '' }}>Pack (Bungkus)
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Tahun / Sumber Perolehan -->

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun / Sumber Perolehan</label>
                            <input type="text" name="tahun_pembuatan" value="{{ old('tahun_pembuatan') }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 shadow-sm"
                                placeholder="Contoh: BOS 2019 atau 2024">
                            <p class="mt-1 text-xs text-gray-500 italic">*Bisa diisi tahun atau keterangan
                                anggaran</p>
                        </div>
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
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 transition ease-in-out shadow-md w-full sm:w-auto justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan & Tambah Lagi
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        // Aktifkan select2 pada dropdown
        $('.select2-kategori').select2({
            placeholder: "Ketik untuk mencari kategori..."
        });
        $('.select2-kondisi').select2({
            placeholder: "Ketik untuk mencari kondisi..."
        });
        $('.select2-ruang').select2({
            placeholder: "Ketik untuk mencari ruang..."
        });
    });
    </script>
</x-app-layout>
