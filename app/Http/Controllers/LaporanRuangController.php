<?php

namespace App\Http\Controllers;


use App\Models\Ruang;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LaporanRuangController extends Controller
{
    // Fungsi untuk Web UI (Paginasi)
    public function show($slug)
    {
        $ruangs = Ruang::where('prodi_id', Auth::user()->prodi_id)->get();
        $ruang = $ruangs->first(function ($r) use ($slug) {
            return Str::slug($r->nama_ruang) === $slug;
        });

        if (!$ruang) abort(404, 'Data Ruang tidak ditemukan');

        // Paginasi 10 data per halaman
        $barangs = Barang::with(['kategori', 'kondisi'])
            ->where('ruang_id', $ruang->id)
            ->latest()
            ->paginate(10);

        return view('laporan.ruang', compact('ruang', 'barangs'));
    }

    // Fungsi khusus untuk Cetak KIR (Semua data tanpa paginasi)
    public function cetak($slug)
    {
        $ruangs = Ruang::where('prodi_id', Auth::user()->prodi_id)->get();
        $ruang = $ruangs->first(function ($r) use ($slug) {
            return Str::slug($r->nama_ruang) === $slug;
        });

        if (!$ruang) abort(404, 'Data Ruang tidak ditemukan');

        // Tarik semua data tanpa batas untuk dicetak
        $barangs = Barang::with(['kategori', 'kondisi'])
            ->where('ruang_id', $ruang->id)
            ->latest()
            ->get();

        return view('laporan.cetak-ruang', compact('ruang', 'barangs'));
    }
}
