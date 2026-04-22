@php
use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pemakaian Bahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: black;
            background-color: white;
        }

        /* UBAH max-width dari 210mm menjadi 297mm (ukuran panjang A4) atau 100% */
        .print-area {
            max-width: 297mm;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px 12px;
            font-size: 12pt;
        }

        th {
            text-transform: uppercase;
            font-weight: bold;
            background-color: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
        }

        @media print {

            /* UBAH portrait menjadi landscape di baris ini 👇 */
            @page {
                margin: 15mm;
                size: A4 landscape;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="print-area">
        <div class="no-print mb-8 text-center">
            <button onclick="window.close()"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg font-sans">
                Tutup Jendela Ini
            </button>
            <button onclick="window.print()"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg font-sans ml-2">
                Cetak Ulang
            </button>
        </div>

        <div class="border-b-[3px] border-black pb-4 mb-6 flex items-center justify-between">
            <div class="w-24"></div>
            <div class="text-center flex-grow">
                <h1 class="text-xl font-bold uppercase tracking-wider">Pemerintah Provinsi Jawa Tengah</h1>
                <h1 class="text-xl font-bold uppercase tracking-wider">Dinas Pendidikan dan Kebudayaan</h1>
                <h2 class="text-2xl font-extrabold uppercase mt-1">SMK Negeri 1 Slawi</h2>
                <p class="text-sm mt-1">Jl. KH. Agus Salim, Procot, Kec. Slawi, Kabupaten Tegal, Jawa Tengah 52411</p>
                <p class="text-sm">Laboratorium {{ Auth::user()->prodi->nama_prodi ?? 'Komputer' }}</p>
            </div>
            <div class="w-24"></div>
        </div>

        <div class="text-center mb-6">
            <h3 class="text-lg font-bold uppercase underline decoration-2 underline-offset-4">Laporan Pemakaian Bahan
                Praktik</h3>
            <p class="mt-2 text-sm">
                Periode:
                @if($request->start_date && $request->end_date)
                {{ \Carbon\Carbon::parse($request->start_date)->format('d/m/Y') }} s.d
                {{ \Carbon\Carbon::parse($request->end_date)->format('d/m/Y') }}
                @else
                Semua Waktu (Hingga {{ now()->format('d F Y') }})
                @endif
            </p>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">No</th>
                    <th style="width: 20%;">Tanggal Pemakaian</th>
                    <th style="width: 25%;">Nama Siswa / Kelas</th>
                    <th style="width: 35%;">Nama Bahan / Barang</th>
                    <th style="width: 15%; text-align: center;">Jumlah Qty</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $item)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ $item->updated_at->format('d M Y - H:i') }}</td>
                    <td>
                        <strong>{{ $item->permintaan->nama_peminta }}</strong><br>
                        <span style="font-size: 10pt;">Kelas: {{ $item->permintaan->kelas ?? '-' }}</span>
                    </td>
                    <td>{{ $item->barang->nama_barang ?? 'Barang Terhapus' }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $item->jumlah }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">Tidak ada data pemakaian pada periode
                        ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-16 flex justify-end">
            <div class="text-center">
                <p>Slawi, {{ now()->format('d F Y') }}</p>
                <p class="font-bold mt-1">Teknisi Laboratorium</p>
                <br><br><br><br>
                <p class="font-bold underline">{{ Auth::user()->name }}</p>
            </div>
        </div>

    </div>
</body>

</html>