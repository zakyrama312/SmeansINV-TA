<?php

namespace App\Models;

use App\Models\DetailPeminjaman;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Menggunakan guarded agar semua field bisa diisi kecuali id
    protected $guarded = ['id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class);
    }

    // Relasi ke detail transaksi (opsional, tapi berguna untuk mengecek histori barang)
    public function detailPeminjamans()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }
}
