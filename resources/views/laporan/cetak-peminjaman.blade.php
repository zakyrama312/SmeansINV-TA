<?php

use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
        font-family: 'Times New Roman', Times, serif;
    }

    .kir-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px;
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
        background-color: #f3f4f6;
        -webkit-print-color-adjust: exact;
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

        <div class="text-center mb-6">
            <h1 class="font-bold text-xl uppercase tracking-wider mb-1">Laporan Data Peminjaman Alat</h1>
            <p class="text-sm font-bold uppercase mb-2">Laboratorium {{ Auth::user()->prodi->nama_prodi ?? '' }} SMK
                Negeri 1 Slawi</p>

            @if(request('start_date') && request('end_date'))
            <p class="text-xs inline-block bg-gray-100 border border-gray-300 px-3 py-1 rounded">
                <strong>Periode:</strong> {{ \Carbon\Carbon::parse(request('start_date'))->translatedFormat('d F Y') }}
                s/d {{ \Carbon\Carbon::parse(request('end_date'))->translatedFormat('d F Y') }}
            </p>
            @else
            <p class="text-xs inline-block bg-gray-100 border border-gray-300 px-3 py-1 rounded">
                <strong>Periode:</strong> Semua Waktu
            </p>
            @endif
        </div>

        <table class="kir-table">
            <thead>
                <tr>
                    <th class="w-10">NO</th>
                    <th class="w-32">KODE TRANSAKSI</th>
                    <th class="w-48">NAMA PEMINJAM</th>
                    <th class="w-24">KELAS</th>
                    <th class="w-auto">DAFTAR ALAT DIPINJAM (JUMLAH)</th>
                    <th class="w-24">TGL PINJAM</th>
                    <th class="w-24">TGL KEMBALI</th>
                    <th class="w-24">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $item->kode_transaksi }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td class="text-center">{{ $item->kelas }}</td>
                    <td>
                        <ul class="list-disc list-inside">
                            @foreach($item->details as $detail)
                            <li>{{ $detail->barang->nama_barang ?? 'Barang Terhapus' }} ({{ $detail->jumlah }} unit)
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') }}</td>
                    <td class="text-center uppercase font-bold">{{ $item->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-6 italic">Tidak ada data peminjaman yang sesuai.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="flex justify-end mt-12 text-xs font-bold text-center px-8">
            <div>
                <p class="font-normal mb-0.5">Slawi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Pengurus Laboratorium</p>
                <div class="h-20"></div>
                <p class="underline decoration-1 underline-offset-2">{{ Auth::user()->name }}</p>
            </div>
        </div>

    </div>
</body>

</html>
