<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Transaksi Permintaan Barang</h2>
                    <p class="text-sm text-gray-500 mt-1">Sistem POS untuk Permintaan Bahan Habis Pakai Lab</p>
                </div>
                <a href="{{ route('permintaan.index') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 shadow-sm transition-all">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Lihat Data Permintaan
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

            <form action="{{ route('permintaan.store') }}" method="POST" id="form-permintaan"
                class="flex flex-col lg:flex-row gap-8">
                @csrf

                <div class="w-full lg:w-2/3 flex flex-col gap-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                        <div class="mb-5 bg-indigo-50 border border-indigo-100 p-4 rounded-xl">
                            <label class="block text-sm font-bold text-indigo-900 mb-2">Scan Barcode Bahan/Barang</label>
                            <div class="flex gap-3">
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="input-barcode" autofocus autocomplete="off" class="bg-white border border-indigo-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full pl-10 p-3 shadow-sm transition-all" placeholder="Tembak pakai alat scanner...">
                                </div>
                                <button type="button" id="btn-open-camera" title="Gunakan Kamera/Webcam" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-colors flex items-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8V6a2 2 0 0 1 2-2h2M3 16v2a2 2 0 0 0 2 2h2M21 8V6a2 2 0 0 0-2-2h-2M21 16v2a2 2 0 0 1-2 2h-2M8 12h8m-4-4v8"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-center mb-5">
                            <span class="text-xs text-gray-400 font-bold uppercase tracking-wider">Atau Cari Manual</span>
                        </div>

                        <div class="flex flex-col sm:flex-row items-end gap-4">
                            <div class="flex-grow w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                                <select id="select-barang"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 block w-full p-3">
                                    <option value="" disabled selected>-- Ketik atau pilih barang --</option>
                                    @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}"
                                        data-nama="{{ $barang->nama_barang }}"
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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 block w-full p-3 text-center">
                            </div>
                            <button type="button" id="btn-tambah"
                                class="w-full sm:w-auto bg-gray-900 text-white hover:bg-gray-800 font-semibold py-3 px-6 rounded-xl transition-all shadow-sm">
                                Tambah
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex-grow flex flex-col overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                            <h3 class="text-base font-bold text-gray-900">Daftar Barang Permintaan</h3>
                            <span id="badge-total"
                                class="bg-indigo-100 text-indigo-800 text-xs font-bold px-3 py-1 rounded-full">0
                                Barang</span>
                        </div>
                        <div class="overflow-x-auto flex-grow">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4 font-semibold">Nama Barang</th>
                                        <th class="px-6 py-4 font-semibold text-center w-28">Jumlah</th>
                                        <th class="px-6 py-4 font-semibold text-center w-28">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table-keranjang" class="divide-y divide-gray-100"></tbody>
                            </table>
                            <div id="empty-state" class="flex flex-col items-center justify-center py-16 px-4">
                                <div class="bg-gray-50 p-4 rounded-full mb-3 border border-gray-100">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-gray-900 font-medium mb-1">Daftar permintaan kosong</h4>
                                <p class="text-sm text-gray-500 text-center">Silakan scan barcode atau pilih barang manual.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-8">
                        <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="bg-indigo-50 p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Data Peminta</h3>
                        </div>

                        <div class="space-y-5 mb-8">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Nama Peminta <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nama_peminta" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 block w-full p-3"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">Kelas <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="kelas" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 block w-full p-3"
                                        placeholder="Cth: XII RPL">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1.5">No WhatsApp <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="no_hp" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 block w-full p-3"
                                        placeholder="08...">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Tanggal Permintaan <span
                                        class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_permintaan" value="{{ date('Y-m-d') }}" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 block w-full p-3">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-1.5">Keterangan
                                    (Opsional)</label>
                                <textarea name="keterangan" rows="2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-indigo-500 block w-full p-3"
                                    placeholder="Contoh: Praktik jaringan di ruang server"></textarea>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-indigo-600 hover:bg-indigo-700 font-bold rounded-xl text-sm px-5 py-3.5 shadow-lg shadow-indigo-600/30 transition-all transform hover:-translate-y-0.5">
                            Ajukan Permintaan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div id="camera-modal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-indigo-50">
                <h3 class="text-lg font-bold text-indigo-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8V6a2 2 0 0 1 2-2h2M3 16v2a2 2 0 0 0 2 2h2M21 8V6a2 2 0 0 0-2-2h-2M21 16v2a2 2 0 0 1-2 2h-2M8 12h8m-4-4v8"></path>
                    </svg>
                    Kamera Scanner
                </h3>
                <button type="button" id="btn-close-camera" class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-1.5 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
            const formPermintaan = document.getElementById('form-permintaan');
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

            // Cegah submit form saat enter di text input
            formPermintaan.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                }
            });

            // LOGIKA KAMERA SCANNER
            btnOpenCamera.addEventListener('click', function() {
                cameraModal.classList.remove('hidden');
                cameraModal.classList.add('flex');
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        },
                        aspectRatio: 1.0
                    },
                    false
                );
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            });

            function closeCamera() {
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear().then(() => {
                        cameraModal.classList.add('hidden');
                        cameraModal.classList.remove('flex');
                        inputBarcode.focus();
                    });
                } else {
                    cameraModal.classList.add('hidden');
                }
            }

            btnCloseCamera.addEventListener('click', closeCamera);

            function onScanSuccess(decodedText, decodedResult) {
                closeCamera();
                inputBarcode.value = decodedText;
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
                /* Abaikan */ }

            // LOGIKA INPUT SCAN BARCODE
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
                        alert(`Barang dengan kode barcode '${scannedCode}' tidak ditemukan!`);
                    }
                    this.value = '';
                    this.focus();
                }
            });

            // LOGIKA TAMBAH KE KERANJANG
            btnTambah.addEventListener('click', function() {
                if (!selectBarang.value) return alert('Pilih barang!');
                const barangId = selectBarang.value;
                const namaBarang = selectBarang.options[selectBarang.selectedIndex].getAttribute('data-nama');
                const stokTersedia = parseInt(selectBarang.options[selectBarang.selectedIndex].getAttribute('data-stok'));
                const jumlah = parseInt(inputJumlah.value);

                if (jumlah > stokTersedia) {
                    alert(`Stok sisa: ${stokTersedia}`);
                    inputBarcode.focus();
                    return;
                }

                // Cek jika barang sudah ada (Auto-increment)
                const existingRow = document.querySelector(`tr[data-id="${barangId}"]`);
                if (existingRow) {
                    const inputHiddenJumlah = existingRow.querySelector('input[name="jumlah[]"]');
                    const displayJumlah = existingRow.querySelector('.display-jumlah');
                    let newQty = parseInt(inputHiddenJumlah.value) + jumlah;

                    if (newQty > stokTersedia) {
                        alert(`Gagal! Total scan melebihi stok. Sisa stok: ${stokTersedia}`);
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

                // Styling menggunakan warna Indigo
                tr.innerHTML = `
                    <td class="px-6 py-4 font-semibold text-gray-900">${namaBarang} <input type="hidden" name="barang_id[]" value="${barangId}"></td>
                    <td class="px-6 py-4 text-center">
                        <span class="display-jumlah px-3 py-1 bg-indigo-50 text-indigo-800 rounded-lg font-bold border border-indigo-200">${jumlah}</span>
                        <input type="hidden" name="jumlah[]" value="${jumlah}">
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button type="button" class="text-red-600 hover:bg-red-600 hover:text-white border border-red-600 rounded-lg px-3 py-1 text-xs btn-hapus transition-colors">Hapus</button>
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

            formPermintaan.addEventListener('submit', function(e) {
                if (tableKeranjang.children.length === 0) {
                    e.preventDefault();
                    alert('Daftar masih kosong!');
                }
            });
        });
    </script>
</x-app-layout>