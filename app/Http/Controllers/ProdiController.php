<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::latest()->get();
        return view('master.prodi.index', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodis,nama_prodi'
        ]);

        Prodi::create(['nama_prodi' => $request->nama_prodi]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        try {
            Prodi::findOrFail($id)->delete();
            return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus!');
        } catch (\Exception $e) {
            // Error jika prodi ini masih dipakai di tabel barang (restrictOnDelete)
            return redirect()->route('prodi.index')->with('error', 'Gagal dihapus! Prodi ini sedang digunakan oleh suatu barang.');
        }
    }
}
