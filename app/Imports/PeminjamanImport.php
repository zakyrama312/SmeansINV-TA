<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeminjamanImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $prodiId = Auth::user()->prodi_id;

        DB::beginTransaction();
        try {
            foreach ($rows as $index => $row) {
                // Pastikan baris tidak kosong
                if (empty($row['kode_barang'])) continue;

                $barang = Barang::where('kode_barang', $row['kode_barang'])
                    ->where('prodi_id', $prodiId)
                    ->first();

                // Ubah logika: Kalau barang nggak ketemu, langsung ERROR aja biar ketahuan salahnya di mana!
                if (!$barang) {
                    throw new \Exception("Gagal: Barang dengan kode " . $row['kode_barang'] . " tidak ditemukan di lab ini (Baris ke-" . ($index + 2) . " di Excel).");
                }

                // Generate Kode Transaksi Otomatis (Format: TRX-TahunBulanTanggal-Random)
                $kodeTransaksi = 'PMJ-' . date('Ymd') . '-' . Str::upper(Str::random(4));

                // 1. LOGIKA TANGGAL PINJAM
                // Cek apakah tanggal berupa angka (format Excel) atau teks biasa (karena tanda petik)
                $tglPinjam = is_numeric($row['tanggal_pinjam'])
                    ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_pinjam'])->format('Y-m-d')
                    : \Carbon\Carbon::parse($row['tanggal_pinjam'])->format('Y-m-d');

                // 2. LOGIKA TANGGAL KEMBALI
                $tglKembali = is_numeric($row['tanggal_kembali'])
                    ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_kembali'])->format('Y-m-d')
                    : \Carbon\Carbon::parse($row['tanggal_kembali'])->format('Y-m-d');

                // 3. Masukkan ke database menggunakan variabel tanggal yang sudah "dibersihkan" di atas
                $peminjaman = Peminjaman::create([
                    'kode_transaksi'  => $kodeTransaksi,
                    'nama_peminjam'   => $row['nama_peminjam'],
                    'kelas'           => $row['kelas'],
                    'tanggal_pinjam'  => $tglPinjam,   // <-- Panggil variabel $tglPinjam
                    'tanggal_kembali' => $tglKembali,  // <-- Panggil variabel $tglKembali
                    'status'          => strtolower($row['status'] ?? 'dipinjam'),
                    'keterangan'      => $row['keterangan'] ?? '-',
                    'prodi_id'        => $prodiId,
                ]);

                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_id'     => $barang->id,
                    'jumlah'        => $row['jumlah'],
                ]);

                if (strtolower($row['status']) == 'dipinjam') {
                    if ($barang->jumlah_tersedia >= $row['jumlah']) {
                        $barang->decrement('jumlah_tersedia', $row['jumlah']);
                    } else {
                        throw new \Exception("Gagal: Stok {$barang->nama_barang} tidak cukup. Diminta: {$row['jumlah']}, Sisa: {$barang->jumlah_tersedia}");
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
