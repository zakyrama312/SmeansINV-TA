<?php

use Illuminate\Support\Facades\Auth;
?>
<table border="1">
    <thead>
        <tr>
            <th colspan="8" style="font-size: 14pt; font-weight: bold; text-align: center;">LAPORAN DATA PEMINJAMAN ALAT
                LABORATORIUM {{ Auth::user()->prodi->nama_prodi ?? '' }}</th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold;">SMK NEGERI 1 SLAWI</th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center;">
                Periode:
                {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') . ' s/d ' . \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') : 'Semua Waktu' }}
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Nama Peminjam</th>
            <th>Kelas / Kontak</th>
            <th>Barang Dipinjam</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjamans as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ $item->nama_peminjam }}</td>
            <td>{{ $item->kelas }} / {{ $item->no_hp }}</td>
            <td>
                @foreach($item->details as $detail)
                - {{ $detail->barang->nama_barang ?? 'Dihapus' }} ({{ $detail->jumlah }} unit)
                @endforeach
            </td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>{{ $item->tanggal_kembali }}</td>
            <td style="font-weight: bold;">{{ strtoupper($item->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>