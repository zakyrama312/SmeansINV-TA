<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Ruang;
use App\Models\Kondisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        // Mengambil data barang beserta relasinya
        $barangs = Barang::with(['prodi', 'kategori', 'ruang', 'kondisi'])->latest()->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        // Tarik data master HANYA untuk prodi teknisi yang sedang login
        $prodi_id = Auth::user()->prodi_id;
        $kategoris = Kategori::where('prodi_id', $prodi_id)->get();
        $ruangs = Ruang::where('prodi_id', $prodi_id)->get();
        $kondisis = Kondisi::where('prodi_id', $prodi_id)->get();

        return view('barang.create', compact('kategoris', 'ruangs', 'kondisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'ruang_id'    => 'required|exists:ruangs,id',
            'kondisi_id'  => 'required|exists:kondisis,id',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
            'merk'        => 'nullable|string|max:255',
            'deskripsi'   => 'nullable|string',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Simpan foto ke folder storage/app/public/barangs
            $fotoPath = $request->file('foto')->store('barangs', 'public');
        }

        // Simpan data ke database
        Barang::create([
            'kode_barang'     => $request->kode_barang,
            'nama_barang'     => $request->nama_barang,
            'stok'            => $request->stok,
            'jumlah_tersedia' => $request->stok, // Saat awal dibuat, jumlah tersedia otomatis sama dengan stok
            'jumlah_total'    => $request->stok, // Sesuai struktur barumu
            'deskripsi'       => $request->deskripsi,
            'merk'            => $request->merk,
            'foto'            => $fotoPath,
            'foto_thumbnail'  => $fotoPath, // Untuk saat ini kita pakai file yang sama, nanti bisa dioptimasi dengan image intervention jika perlu
            'kategori_id'     => $request->kategori_id,
            'ruang_id'        => $request->ruang_id,
            'kondisi_id'      => $request->kondisi_id,
            'prodi_id'        => Auth::user()->prodi_id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan ke inventaris!');
    }

    public function edit($id)
    {
        // Pastikan barang yang diedit HANYA milik prodi user yang login
        $prodi_id = Auth::user()->prodi_id;
        $barang = Barang::where('id', $id)->where('prodi_id', $prodi_id)->firstOrFail();

        $kategoris = Kategori::where('prodi_id', $prodi_id)->get();
        $ruangs = Ruang::where('prodi_id', $prodi_id)->get();
        $kondisis = Kondisi::where('prodi_id', $prodi_id)->get();

        return view('barang.edit', compact('barang', 'kategoris', 'ruangs', 'kondisis'));
    }

    public function update(Request $request, $id)
    {
        $prodi_id = Auth::user()->prodi_id;
        $barang = Barang::where('id', $id)->where('prodi_id', $prodi_id)->firstOrFail();

        $request->validate([
            // unique mengabaikan id barang ini sendiri saat diedit
            'kode_barang' => 'required|string|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'ruang_id'    => 'required|exists:ruangs,id',
            'kondisi_id'  => 'required|exists:kondisis,id',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'merk'        => 'nullable|string|max:255',
            'deskripsi'   => 'nullable|string',
        ]);

        // LOGIKA PENYESUAIAN STOK YANG AMAN
        $selisihStok = $request->stok - $barang->stok;
        $jumlahTersediaBaru = $barang->jumlah_tersedia + $selisihStok;

        // Cegah error jika stok dikurangi melebihi barang yang sedang dipinjam
        if ($jumlahTersediaBaru < 0) {
            return back()->withInput()->withErrors(['stok' => 'Gagal! Stok tidak bisa dikurangi karena sebagian besar barang masih dipinjam siswa.']);
        }

        // Urus Foto Baru jika diupload
        $fotoPath = $barang->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
                Storage::disk('public')->delete($barang->foto);
            }
            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('barangs', 'public');
        }

        // Update Data ke Database
        $barang->update([
            'kode_barang'     => $request->kode_barang,
            'nama_barang'     => $request->nama_barang,
            'stok'            => $request->stok,
            'jumlah_tersedia' => $jumlahTersediaBaru,
            'jumlah_total'    => $request->stok,
            'deskripsi'       => $request->deskripsi,
            'merk'            => $request->merk,
            'foto'            => $fotoPath,
            'foto_thumbnail'  => $fotoPath,
            'kategori_id'     => $request->kategori_id,
            'ruang_id'        => $request->ruang_id,
            'kondisi_id'      => $request->kondisi_id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }
}
