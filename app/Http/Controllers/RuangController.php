<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuangController extends Controller
{
    public function index()
    {
        // HANYA tampilkan ruang yang prodi_id-nya sama dengan prodi teknisi yang sedang login
        $ruangs = Ruang::where('prodi_id', Auth::user()->prodi_id)->latest()->get();
        return view('master.ruang.index', compact('ruangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validasi nama ruang unik HANYA di dalam prodi yang sama
            'nama_ruang' => 'required|string|max:255|unique:ruangs,nama_ruang,NULL,id,prodi_id,' . Auth::user()->prodi_id
        ]);

        // Otomatis masukkan prodi_id berdasarkan user yang sedang login
        Ruang::create([
            'nama_ruang' => $request->nama_ruang,
            'prodi_id'      => Auth::user()->prodi_id
        ]);

        return redirect()->route('ruang.index')->with('success', 'Ruang berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        try {
            Ruang::findOrFail($id)->delete();
            return redirect()->route('ruang.index')->with('success', 'Ruang berhasil dihapus!');
        } catch (\Exception $e) {
            // Error jika ruang ini masih dipakai di tabel barang (restrictOnDelete)
            return redirect()->route('ruang.index')->with('error', 'Gagal dihapus! Ruang ini sedang digunakan oleh suatu barang.');
        }
    }
}
