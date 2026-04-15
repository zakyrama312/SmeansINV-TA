<?php

namespace App\Models;

use App\Models\DetailPeminjaman;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{

    protected $table = 'peminjamans';
    protected $guarded = ['id'];

    // Relasi ke User (Siapa yang pinjam)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke banyak Detail (Barang apa saja yang dipinjam)
    public function details()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
