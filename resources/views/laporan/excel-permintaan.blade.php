<?php

use Illuminate\Support\Facades\Auth;
?>
<table border="1">
    <thead>
        <tr>
            <th colspan="7" style="font-size: 14pt; font-weight: bold; text-align: center;">LAPORAN PENGELUARAN BAHAN
                HABIS PAKAI LABORATORIUM {{ Auth::user()->prodi->nama_prodi ?? '' }}</th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center; font-weight: bold;">SMK NEGERI 1 SLAWI</th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: center;">
                Periode:
                {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') . ' s/d ' . \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') : 'Semua Waktu' }}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Nama Peminta</th>
            <th>Kelas / Kontak</th>
            <th>Bahan Habis Pakai (Jumlah)</th>
            <th>Tanggal Pengajuan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($permintaans as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ $item->nama_peminta }}</td>
            <td>{{ $item->kelas }} / {{ $item->no_hp }}</td>
            <td>
                @foreach($item->details as $detail)
                - {{ $detail->barang->nama_barang ?? 'Dihapus' }} ({{ $detail->jumlah }} unit)
                @endforeach
            </td>
            <td>{{ $item->tanggal_permintaan }}</td>
            <td style="font-weight: bold;">{{ strtoupper($item->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>