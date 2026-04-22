<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Transaksi Peminjaman</h2>
                    <p class="text-sm text-gray-500 mt-1">Peminjaman Alat dan Bahan Laboratorium
                    </p>
                </div>
                <a href="{{ route('peminjaman.index') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm transition-all">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Lihat Data Peminjaman
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

            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 p-5 rounded-xl shadow-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <p class="text-red-800 font-bold">Mohon periksa kembali inputan Anda:</p>
                </div>
                <ul class="list-disc list-inside text-sm text-red-600 ml-7 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST" id="form-peminjaman"
                class="flex flex-col lg:flex-row gap-8">
                @csrf

                <div class="w-full lg:w-2/3 flex flex-col gap-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                        <div class="mb-5 bg-blue-50 border border-blue-100 p-4 rounded-xl">
                            <label class="block text-sm font-bold text-blue-900 mb-2">Scan Barcode Alat</label>
                            <div class="flex gap-3">
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" id="input-barcode" autofocus autocomplete="off"
                                        class="bg-white border border-blue-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full pl-10 p-3 shadow-sm transition-all"
                                        placeholder="Tembak pakai alat scanner...">
                                </div>
                                <button type="button" id="btn-open-camera"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-colors flex items-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-center mb-5">
                            <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Atau Cari
                                Manual</span>
                        </div>

                        <div class="flex flex-col sm:flex-row items-end gap-4">
                            <div class="flex-grow w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                                <select id="select-barang"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150 ease-in-out">
                                    <option value="" disabled selected>-- Ketik atau pilih barang --</option>
                                    @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}" data-nama="{{ $barang->nama_barang }}"
                                        data-kode="{{ $barang->kode_barang }}"
                                        data-stok="{{ $barang->jumlah_tersedia }}">
                                        {{ $barang->kode_barang }} - {{ $barang->nama_barang }} (Sisa:
                                        {{ $barang->jumlah_tersedia }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full sm:w-32">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                                <input type="number" id="input-jumlah" min="1" value="1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 text-center transition duration-150 ease-in-out">
                            </div>
                            <button type="button" id="btn-tambah"
                                class="w-full sm:w-auto bg-gray-900 text-white hover:bg-gray-800 font-semibold py-3 px-6 rounded-xl transition-all shadow-sm flex items-center justify-center">
                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah
                            </button>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-200 flex-grow flex flex-col overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-white flex justify-between items-center">
                            <h3 class="text-base font-bold text-gray-900">Daftar Barang Pinjaman</h3>
                            <span id="badge-total"
                                class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">0
                                Barang</span>
                        </div>

                        <div class="overflow-x-auto flex-grow">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4 font-semibold tracking-wider">Nama Barang</th>
                                        <th class="px-6 py-4 font-semibold tracking-wider text-center w-28">Jumlah</th>
                                        <th class="px-6 py-4 font-semibold tracking-wider text-center w-28">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table-keranjang" class="divide-y divide-gray-100 bg-white">
                                </tbody>
                            </table>

                            <div id="empty-state" class="flex flex-col items-center justify-center py-16 px-4">
                                <div class="bg-gray-50 p-4 rounded-full mb-3 border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-gray-900 font-medium mb-1">Keranjang masih kosong</h4>
                                <p class="text-sm text-gray-500 text-center">Silakan scan barcode atau pilih barang
                                    secara manual.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-8">
                        <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="bg-blue-50 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Data Peminjam</h3>
                        </div>

                        <div class="space-y-5 mb-8">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Peminjam <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150"
                                    placeholder="Masukkan nama lengkap">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kelas <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="kelas" value="{{ old('kelas') }}" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150"
                                        placeholder="Cth: XII RPL">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nomor WhatsApp <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150"
                                        placeholder="08...">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tanggal Pinjam <span
                                            class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_pinjam"
                                        value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tanggal Kembali
                                        <span class="text-red-500">*</span></label>
                                    <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                                        required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Keterangan
                                    (Opsional)</label>
                                <textarea name="keterangan" rows="3"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-150"
                                    placeholder="Contoh: Praktik jaringan di ruang server">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 font-bold rounded-xl text-sm px-5 py-3.5 text-center shadow-lg shadow-blue-600/30 transition-all duration-200 transform hover:-translate-y-0.5">
                            Ajukan Peminjaman
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div id="camera-modal"
        class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                        </path>
                    </svg>
                    Kamera Scanner
                </h3>
                <button type="button" id="btn-close-camera"
                    class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-1.5 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <div id="reader" width="100%"></div>
                <p class="text-center text-sm text-gray-500 mt-4">Arahkan garis kamera ke Barcode/QR Code barang.</p>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputBarcode = document.getElementById('input-barcode');
            const btnTambah = document.getElementById('btn-tambah');
            const selectBarang = document.getElementById('select-barang');
            const inputJumlah = document.getElementById('input-jumlah');
            const tableKeranjang = document.getElementById('table-keranjang');
            const emptyState = document.getElementById('empty-state');
            const formPeminjaman = document.getElementById('form-peminjaman');
            const badgeTotal = document.getElementById('badge-total');

            // Elemen Kamera
            const btnOpenCamera = document.getElementById('btn-open-camera');
            const btnCloseCamera = document.getElementById('btn-close-camera');
            const cameraModal = document.getElementById('camera-modal');
            let html5QrcodeScanner = null;

            let totalItemCount = 0;

            function updateTotalBadge() {
                badgeTotal.textContent = `${totalItemCount} Macam Barang`;
            }

            formPeminjaman.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                }
            });

            // ==========================================
            // LOGIKA KAMERA SCANNER
            // ==========================================
            btnOpenCamera.addEventListener('click', function() {
                cameraModal.classList.remove('hidden');
                cameraModal.classList.add('flex');

                // Setingan scanner, menggunakan kamera belakang (environment) jika ada
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        },
                        aspectRatio: 1.0
                    },
                    /* verbose= */
                    false
                );

                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            });

            function closeCamera() {
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear().then(() => {
                        cameraModal.classList.add('hidden');
                        cameraModal.classList.remove('flex');
                        inputBarcode.focus(); // Kembalikan fokus ke input
                    }).catch(error => {
                        console.error("Gagal menutup kamera", error);
                    });
                } else {
                    cameraModal.classList.add('hidden');
                }
            }

            btnCloseCamera.addEventListener('click', closeCamera);

            function onScanSuccess(decodedText, decodedResult) {
                // Jika berhasil scan, tutup kamera
                closeCamera();

                // Masukkan hasil ke kotak input
                inputBarcode.value = decodedText;

                // Buat event "Enter" buatan agar kode diproses seperti di-scan alat fisik
                const enterEvent = new KeyboardEvent('keydown', {
                    key: 'Enter',
                    code: 'Enter',
                    keyCode: 13,
                    which: 13,
                    bubbles: true
                });
                inputBarcode.dispatchEvent(enterEvent);
            }

            function onScanFailure(error) {
                // Abaikan error saat tidak ada barcode di layar, scanner jalan terus
            }

            // ==========================================
            // LOGIKA MEMASUKKAN BARANG DARI KODE
            // ==========================================
            inputBarcode.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const scannedCode = this.value.trim().toLowerCase();
                    if (!scannedCode) return;

                    let foundOption = null;

                    Array.from(selectBarang.options).forEach(option => {
                        const kode = option.getAttribute('data-kode');
                        if (kode && kode.toLowerCase() === scannedCode) {
                            foundOption = option;
                        }
                    });

                    if (foundOption) {
                        selectBarang.value = foundOption.value;
                        inputJumlah.value = 1;
                        btnTambah.click();
                    } else {
                        alert(`Barang dengan kode barcode '${scannedCode}' tidak ditemukan di database!`);
                    }

                    this.value = '';
                    this.focus();
                }
            });

            btnTambah.addEventListener('click', function() {
                if (!selectBarang.value) {
                    alert('Silakan pilih barang dari laboratorium terlebih dahulu!');
                    return;
                }

                const barangId = selectBarang.value;
                const namaBarang = selectBarang.options[selectBarang.selectedIndex].getAttribute(
                    'data-nama');
                const stokTersedia = parseInt(selectBarang.options[selectBarang.selectedIndex].getAttribute(
                    'data-stok'));
                const jumlah = parseInt(inputJumlah.value);

                if (jumlah > stokTersedia) {
                    alert(`Stok tidak mencukupi! Sisa stok fisik: ${stokTersedia}`);
                    inputBarcode.focus();
                    return;
                }

                const existingRow = document.querySelector(`tr[data-id="${barangId}"]`);
                if (existingRow) {
                    const inputHiddenJumlah = existingRow.querySelector('input[name="jumlah[]"]');
                    const displayJumlah = existingRow.querySelector('.display-jumlah');
                    let newQty = parseInt(inputHiddenJumlah.value) + jumlah;

                    if (newQty > stokTersedia) {
                        alert(`Gagal! Total scan melebihi stok. Sisa stok fisik: ${stokTersedia}`);
                        inputBarcode.focus();
                        return;
                    }

                    inputHiddenJumlah.value = newQty;
                    displayJumlah.textContent = newQty;
                    selectBarang.value = '';
                    inputJumlah.value = 1;
                    inputBarcode.focus();
                    return;
                }

                emptyState.style.display = 'none';
                const tr = document.createElement('tr');
                tr.setAttribute('data-id', barangId);
                tr.classList.add('hover:bg-gray-50', 'transition-colors');

                tr.innerHTML = `
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">${namaBarang}</div>
                    <input type="hidden" name="barang_id[]" value="${barangId}">
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="display-jumlah inline-flex items-center justify-center px-3 py-1 rounded-lg bg-blue-50 text-blue-800 font-bold border border-blue-200">${jumlah}</span>
                    <input type="hidden" name="jumlah[]" value="${jumlah}">
                </td>
                <td class="px-6 py-4 text-center">
                    <button type="button" class="text-red-600 hover:text-white border border-red-600 hover:bg-red-600 font-medium rounded-lg text-xs px-3 py-1.5 text-center transition-all btn-hapus">
                        Hapus
                    </button>
                </td>
            `;

                tr.querySelector('.btn-hapus').addEventListener('click', function() {
                    tr.remove();
                    totalItemCount--;
                    updateTotalBadge();
                    if (tableKeranjang.children.length === 0) emptyState.style.display = 'flex';
                    inputBarcode.focus();
                });

                tableKeranjang.appendChild(tr);
                totalItemCount++;
                updateTotalBadge();

                selectBarang.value = '';
                inputJumlah.value = 1;
                inputBarcode.focus();
            });

            formPeminjaman.addEventListener('submit', function(e) {
                if (tableKeranjang.children.length === 0) {
                    e.preventDefault();
                    alert('Daftar pinjaman masih kosong! Silakan scan atau pilih minimal satu barang.');
                }
            });
        });
    </script>
</x-app-layout>