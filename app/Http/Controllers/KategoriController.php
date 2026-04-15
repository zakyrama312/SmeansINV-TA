<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        // HANYA tampilkan kategori yang prodi_id-nya sama dengan prodi teknisi yang sedang login
        $kategoris = Kategori::where('prodi_id', Auth::user()->prodi_id)->latest()->get();
        return view('master.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validasi nama kategori unik HANYA di dalam prodi yang sama
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,NULL,id,prodi_id,' . Auth::user()->prodi_id
        ]);

        // Otomatis masukkan prodi_id berdasarkan user yang sedang login
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'prodi_id'      => Auth::user()->prodi_id
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        try {
            Kategori::findOrFail($id)->delete();
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            // Error jika kategori ini masih dipakai di tabel barang (restrictOnDelete)
            return redirect()->route('kategori.index')->with('error', 'Gagal dihapus! Kategori ini sedang digunakan oleh suatu barang.');
        }
    }
}
