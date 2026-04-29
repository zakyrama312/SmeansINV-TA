<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak KIR - {{ $ruang->nama_ruang }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: white;
            color: black;
        }

        .kir-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 15px;
        }

        .kir-table th,
        .kir-table td {
            border: 1px solid black;
            padding: 6px 4px;
        }

        .kir-table th {
            font-weight: bold;
            text-align: center;
        }

        @media print {
            @page {
                size: landscape;
                margin: 15mm;
            }

            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="max-w-[1400px] mx-auto p-4">
        <h1 class="text-center font-bold text-xl uppercase tracking-wider mb-6">Kartu Inventaris Ruangan</h1>

        <div class="flex justify-between items-end mb-4 text-xs font-bold uppercase">
            <table class="text-left">
                <tr>
                    <td class="pr-4 pb-1">KABUPATEN/KOTA</td>
                    <td class="pb-1">: KABUPATEN TEGAL</td>
                </tr>
                <tr>
                    <td class="pr-4 pb-1">PROVINSI</td>
                    <td class="pb-1">: JAWA TENGAH</td>
                </tr>
                <tr>
                    <td class="pr-4 pb-1">UNIT KERJA</td>
                    <td class="pb-1">: DINAS PENDIDIKAN DAN KEBUDAYAAN</td>
                </tr>
                <tr>
                    <td class="pr-4 pb-1">SATUAN KERJA</td>
                    <td class="pb-1">: SMK NEGERI 1 SLAWI</td>
                </tr>
                <tr>
                    <td class="pr-4 pb-1">RUANGAN</td>
                    <td class="pb-1">: {{ strtoupper($ruang->nama_ruang) }}</td>
                </tr>
            </table>
            <div class="text-right pb-1">
                NO. KODE LOKASI : 1.01.01.12.05.12
            </div>
        </div>

        <table class="kir-table">
            <thead>
                <tr>
                    <th class="w-8">NO</th>
                    <th class="w-48">Nama Barang</th>
                    <th class="w-32">Merk / Model</th>
                    <th class="w-40">Spesifikasi</th>
                    <!-- <th class="w-16">Ukuran</th>
                    <th class="w-16">Bahan</th> -->
                    <th class="w-24">Tahun Pengadaan</th>
                    <th class="w-24">Kode Barang</th>
                    <th class="w-16">Jumlah Barang</th>
                    <!-- <th class="w-24">Harga Beli</th> -->
                    <th class="w-20">Keadaan Barang</th>
                    <th class="w-32">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->merk ?? '-' }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <!-- <td class="text-center">{{ $item->ukuran ?? '-' }}</td>
                    <td class="text-center">{{ $item->bahan ?? '-' }}</td> -->
                    <td class="text-center">{{ $item->tahun_pembuatan ?? '-' }}</td>
                    <td class="text-center">{{ $item->kode_barang ?? '-' }}</td>
                    <td class="text-center font-bold">{{ $item->stok }}</td>
                    <!-- <td class="text-right">
                        {{ $item->harga_beli ? 'Rp ' . number_format($item->harga_beli, 0, ',', '.') : '-' }}
                    </td> -->
                    <td class="text-center">{{ $item->kondisi->nama_kondisi ?? '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-8 italic text-gray-500">Belum ada data barang di ruangan ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="flex justify-between mt-12 text-xs font-bold text-center px-8">
            <div>
                <p>Mengetahui,</p>
                <p>Kepala SMK Negeri 1 Slawi</p>
                <div class="h-20"></div>
                <p class="underline decoration-1 underline-offset-2">Dra. Lutfah Barliana, M.Pd</p>
                <p class="font-normal mt-0.5">NIP. 19701127 199802 2 005</p>
            </div>
            <div>
                <p class="font-normal mb-0.5">Slawi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Pengurus Barang</p>
                <div class="h-20"></div>
                <p class="underline decoration-1 underline-offset-2">Harwoto</p>
                <p class="font-normal mt-0.5">NIP. 19780612 200901 1 008</p>
            </div>
        </div>
    </div>
</body>

</html>