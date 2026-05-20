<?php

namespace App\Imports;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // Tambahkan ini agar baris pertama dibaca sebagai judul

class BarangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // $row['nama_kolom_excel']
        return new Barang([
            'kode_barang'     => $row['kode_barang'],
            'nama_barang'     => $row['nama_barang'],
            'deskripsi'       => $row['deskripsi'] ?? null, // Tangkap data deskripsi
            'merk'            => $row['merk'] ?? null, // Tangkap data merk
            'kategori_id'     => $row['kategori_id'],
            'kondisi_id'      => $row['kondisi_id'],
            'ruang_id'        => $row['ruang_id'],
            'stok'            => $row['stok'],
            'jumlah_tersedia' => $row['stok'],
            'satuan'          => $row['satuan'],
            'tahun_pembuatan' => $row['tahun_pembuatan'] ?? null,
            'prodi_id'        => Auth::user()->prodi_id, // INI KUNCINYA! Biar masuk ke lab yang benar
        ]);
    }
}
