<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KondisiController extends Controller
{
    public function index()
    {
        // HANYA tampilkan kondisi yang prodi_id-nya sama dengan prodi teknisi yang sedang login
        $kondisis = Kondisi::where('prodi_id', Auth::user()->prodi_id)->latest()->get();
        return view('master.kondisi.index', compact('kondisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validasi nama kategori unik HANYA di dalam prodi yang sama
            'nama_kondisi' => 'required|string|max:255|unique:kondisis,nama_kondisi,NULL,id,prodi_id,' . Auth::user()->prodi_id
        ]);

        // Otomatis masukkan prodi_id berdasarkan user yang sedang login
        Kondisi::create([
            'nama_kondisi' => $request->nama_kondisi,
            'prodi_id'      => Auth::user()->prodi_id
        ]);

        return redirect()->route('kondisi.index')->with('success', 'Kondisi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        try {
            Kondisi::findOrFail($id)->delete();
            return redirect()->route('kondisi.index')->with('success', 'Kondisi berhasil dihapus!');
        } catch (\Exception $e) {
            // Error jika kondisi ini masih dipakai di tabel barang (restrictOnDelete)
            return redirect()->route('kondisi.index')->with('error', 'Gagal dihapus! Kondisi ini sedang digunakan oleh suatu barang.');
        }
    }
}
