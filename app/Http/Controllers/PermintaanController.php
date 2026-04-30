<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\DetailPermintaan;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function index(Request $request)
    {
        $prodiId = Auth::user()->prodi_id;
        $query = Permintaan::with('details.barang')->where('prodi_id', $prodiId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_permintaan', [$request->start_date, $request->end_date]);
        }

        $permintaans = $query->orderBy('tanggal_permintaan', 'desc')->paginate(10)->withQueryString();

        // Hitung statistik (Hanya 3 kotak: Pending, Disetujui, Ditolak)
        $statPending   = Permintaan::where('prodi_id', $prodiId)->where('status', 'pending')->count();
        $statDisetujui = Permintaan::where('prodi_id', $prodiId)->where('status', 'disetujui')->count();
        $statDitolak   = Permintaan::where('prodi_id', $prodiId)->where('status', 'ditolak')->count();

        return view('permintaan.index', compact('permintaans', 'statPending', 'statDisetujui', 'statDitolak'));
    }

    public function create()
    {
        $barangs = Barang::where('prodi_id', Auth::user()->prodi_id)
            ->whereHas('kategori', function ($query) {
                // Pastikan di master data Kategori, kamu memberi nama yang ada kata "Bahan"
                // Contoh: "Bahan Praktik", "Bahan Habis Pakai", "Bahan Jaringan"
                $query->where('nama_kategori', 'LIKE', '%Bahan%');
            })
            ->where('jumlah_tersedia', '>', 0)
            ->get();
        return view('permintaan.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminta'       => 'required|string|max:255',
            'kelas'              => 'required|string|max:255',
            'no_hp'              => 'required|string|max:20',
            'tanggal_permintaan' => 'required|date',
            'keterangan'         => 'nullable|string',
            'barang_id'          => 'required|array',
            'jumlah'             => 'required|array',
        ]);


        DB::beginTransaction();
        try {
            $nama_peminta = $request->nama_peminta;
            $barang_ids = $request->barang_id; // Array ID barang yang diminta di keranjang

            $belumHabis = DetailPermintaan::whereIn('barang_id', $barang_ids)
                ->where('status_penggunaan', 'belum_habis')
                ->whereHas('permintaan', function ($q) use ($nama_peminta) {
                    // Cek apakah siswa dengan nama yang SAMA PERSIS masih punya barang tsb
                    $q->where('nama_peminta', $nama_peminta)
                        ->whereIn('status', ['pending', 'disetujui']);
                })->first();

            if ($belumHabis) {
                $namaBarang = $belumHabis->barang->nama_barang ?? 'Barang ini';
                return back()->with('error', "Akses Ditolak! Siswa atas nama '{$nama_peminta}' belum melaporkan '{$namaBarang}' habis dipakai. Silakan Lapor Habis di Dashboard terlebih dahulu!")->withInput();
            }
            $permintaan = Permintaan::create([
                'kode_transaksi'     => 'PMT-' . date('Ymd') . '-' . Str::upper(Str::random(4)),
                'nama_peminta'       => $request->nama_peminta,
                'kelas'              => $request->kelas,
                'no_hp'              => $request->no_hp,
                'prodi_id'           => Auth::user()->prodi_id,
                'tanggal_permintaan' => $request->tanggal_permintaan,
                'keterangan'         => $request->keterangan,
                'status'             => 'pending'
            ]);

            foreach ($request->barang_id as $key => $barangId) {
                DetailPermintaan::create([
                    'permintaan_id' => $permintaan->id,
                    'barang_id'     => $barangId,
                    'jumlah'        => $request->jumlah[$key],
                    'status_penggunaan' => 'belum_habis',
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Form permintaan barang berhasil diajukan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        DB::beginTransaction();
        try {
            $permintaan = Permintaan::with('details')->where('id', $id)->where('prodi_id', Auth::user()->prodi_id)->firstOrFail();

            if ($permintaan->status != 'pending') return redirect()->back()->with('error', 'Status tidak valid.');

            $permintaan->update(['status' => 'disetujui']);

            // PENGURANGAN STOK PERMANEN
            foreach ($permintaan->details as $detail) {
                $barang = Barang::findOrFail($detail->barang_id);
                if ($barang->jumlah_tersedia < $detail->jumlah) {
                    throw new \Exception("Stok {$barang->nama_barang} tidak mencukupi.");
                }

                // Kurangi 'jumlah_tersedia' DAN 'stok' total karena ini barang habis pakai
                $barang->decrement('jumlah_tersedia', $detail->jumlah);
                $barang->decrement('stok', $detail->jumlah);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Permintaan disetujui. Stok barang telah dikurangi secara permanen.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyetujui: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['alasan_penolakan' => 'required|string|max:255']);
        try {
            $permintaan = Permintaan::where('id', $id)->where('prodi_id', Auth::user()->prodi_id)->firstOrFail();

            if ($permintaan->status != 'pending') return redirect()->back()->with('error', 'Status tidak valid.');

            $keteranganBaru = "Ditolak: " . $request->alasan_penolakan;
            if ($permintaan->keterangan) $keteranganBaru .= " (Ket Awal: " . $permintaan->keterangan . ")";

            $permintaan->update([
                'status' => 'ditolak',
                'keterangan' => $keteranganBaru
            ]);

            return redirect()->back()->with('success', 'Permintaan berhasil ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak: ' . $e->getMessage());
        }
    }
    // Fungsi khusus untuk Tombol Lapor Habis
    public function laporHabis($id)
    {
        $detail = DetailPermintaan::findOrFail($id);
        $detail->update(['status_penggunaan' => 'habis']);

        return back()->with('success', 'Hebat! Barang berhasil dilaporkan habis. Kamu sekarang bisa meminta barang itu lagi jika butuh.');
    }

    // Fungsi untuk menampilkan rekap bahan yang sudah habis dipakai

}
