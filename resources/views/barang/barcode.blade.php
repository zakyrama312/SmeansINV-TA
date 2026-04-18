<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Label Barcode - {{ $barang->kode_barang }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
        }

        /* Desain Stiker Individual */
        .label-sticker {
            width: 5.5cm;
            height: 3.5cm;
            padding: 8px;
            border: 1px solid #000;
            border-radius: 6px;
            text-align: center;
            background-color: white;
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            margin: 0.2cm;
            page-break-inside: avoid;
        }

        /* Hilangkan margin bawaan browser dan paksa warna saat cetak */
        @media print {
            @page {
                margin: 1cm;
                size: A4;
            }

            body {
                background-color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            .label-sticker {
                border: 1px solid black !important;
                box-shadow: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="no-print bg-white p-4 shadow-sm mb-8 flex justify-between items-center max-w-5xl mx-auto mt-6 rounded-xl border border-gray-200">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Pratinjau Cetak Label: {{ $barang->nama_barang }}</h2>
            @php
            // Pastikan minimal mencetak 1 stiker meskipun stoknya 0
            $jumlahCetak = $barang->stok > 0 ? $barang->stok : 1;
            @endphp
            <p class="text-sm text-gray-500">Mencetak <b>{{ $jumlahCetak }} stiker</b>.</p>
        </div>
        <div class="flex gap-3">
            <button onclick="window.close()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-lg transition-colors">Tutup</button>
            <button onclick="window.print()" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-lg shadow-md transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Mulai Mencetak
            </button>
        </div>
    </div>

    <div class="max-w-5xl mx-auto flex flex-wrap justify-center content-start pb-10">

        @for($i = 0; $i < $jumlahCetak; $i++)
            <div class="label-sticker shadow-sm">
            <div class="text-[10px] font-extrabold uppercase tracking-widest text-gray-900 leading-tight">SMK NEGERI 1 SLAWI</div>
            <div class="text-[8px] font-bold uppercase text-gray-600 mb-1 pb-1 border-b border-gray-300 w-full">LAB {{ Auth::user()->prodi->nama_prodi ?? 'KOMPUTER' }}</div>

            <svg class="generate-barcode w-full" data-nilai="{{ $barang->kode_barang }}"></svg>

            <div class="text-[9px] font-bold text-gray-900 mt-1 uppercase whitespace-nowrap overflow-hidden text-ellipsis w-full px-2" title="{{ $barang->nama_barang }}">
                {{ $barang->nama_barang }}
            </div>
    </div>
    @endfor

    </div>

    <script>
        // Pastikan semua aset halaman selesai dimuat sebelum merender barcode
        window.addEventListener('load', function() {

            // Cari semua elemen SVG yang harus dijadikan barcode
            const barcodeElements = document.querySelectorAll('.generate-barcode');

            // Loop manual dan buat barcodenya satu per satu
            barcodeElements.forEach(function(svgElement) {
                const nilaiBarcode = svgElement.getAttribute('data-nilai');

                JsBarcode(svgElement, nilaiBarcode, {
                    format: "CODE128",
                    lineColor: "#000000",
                    width: 1.5,
                    height: 40,
                    displayValue: true,
                    fontSize: 12,
                    fontOptions: "bold",
                    margin: 2
                });
            });

            // Beri jeda sedikit agar gambar selesai ter-render sebelum pop-up print muncul otomatis
            setTimeout(function() {
                window.print();
            }, 800);

        });
    </script>
</body>

</html>