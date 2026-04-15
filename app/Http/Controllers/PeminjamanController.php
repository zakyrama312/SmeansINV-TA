<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $prodiId = Auth::user()->prodi_id;

        // Mulai Query peminjaman
        $query = Peminjaman::with('details.barang')->where('prodi_id', $prodiId);

        // 1. Logika Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 2. Logika Filter Tanggal (Berdasarkan tanggal_pinjam)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }

        $peminjamans = $query->latest()->get();

        // Hitung statistik untuk Widget Kartu (Tetap hitung semua data tanpa filter)
        $statPending   = Peminjaman::where('prodi_id', $prodiId)->where('status', 'pending')->count();
        $statDipinjam  = Peminjaman::where('prodi_id', $prodiId)->where('status', 'dipinjam')->count();
        $statSelesai   = Peminjaman::where('prodi_id', $prodiId)->where('status', 'selesai')->count();
        $statDitolak   = Peminjaman::where('prodi_id', $prodiId)->where('status', 'ditolak')->count();

        return view('peminjaman.index', compact('peminjamans', 'statPending', 'statDipinjam', 'statSelesai', 'statDitolak'));
    }
    public function create()
    {
        // Hanya tampilkan barang dari prodi siswa yang login & stok tersedia > 0
        $barangs = Barang::where('prodi_id', Auth::user()->prodi_id)
            ->where('jumlah_tersedia', '>', 0)
            ->get();

        return view('peminjaman.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam'   => 'required|string|max:255',
            'kelas'           => 'required|string|max:255',
            'no_hp'           => 'required|string|max:20',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'keterangan'      => 'nullable|string',
            'barang_id'       => 'required|array',
            'jumlah'          => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::create([
                'kode_transaksi'  => 'PINJAM-' . date('Ymd') . '-' . Str::upper(Str::random(4)),
                'nama_peminjam'   => $request->nama_peminjam,
                'kelas'           => $request->kelas,
                'no_hp'           => $request->no_hp,
                'prodi_id'        => Auth::user()->prodi_id,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'keterangan'      => $request->keterangan,
                'status'          => 'pending'
            ]);

            foreach ($request->barang_id as $key => $barangId) {
                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id,
                    'barang_id'     => $barangId,
                    'jumlah'        => $request->jumlah[$key],
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Transaksi peminjaman berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ... (Fungsi approve & return admin biarkan dulu)


    // 2. Fungsi untuk Teknisi menyetujui pinjaman (Di Loan Approval Page)
    public function approve($id)
    {
        DB::beginTransaction();
        try {
            // Pastikan hanya data dari prodi yang sama yang bisa divalidasi
            $peminjaman = Peminjaman::with('details')->where('id', $id)->where('prodi_id', Auth::user()->prodi_id)->firstOrFail();

            if ($peminjaman->status != 'pending') {
                return redirect()->back()->with('error', 'Status peminjaman tidak valid untuk disetujui.');
            }

            // Ubah status menjadi dipinjam
            $peminjaman->update(['status' => 'dipinjam']);

            // Kurangi 'jumlah_tersedia' di tabel barang
            foreach ($peminjaman->details as $detail) {
                $barang = Barang::findOrFail($detail->barang_id);

                if ($barang->jumlah_tersedia < $detail->jumlah) {
                    throw new \Exception("Stok {$barang->nama_barang} tidak mencukupi untuk dipinjam.");
                }

                $barang->decrement('jumlah_tersedia', $detail->jumlah);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Peminjaman disetujui. Stok barang telah dikurangi otomatis.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyetujui: ' . $e->getMessage());
        }
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:255'
        ]);

        try {
            $peminjaman = Peminjaman::where('id', $id)->where('prodi_id', Auth::user()->prodi_id)->firstOrFail();

            if ($peminjaman->status != 'pending') {
                return redirect()->back()->with('error', 'Hanya peminjaman berstatus pending yang bisa ditolak.');
            }

            // Format keterangan: Timpa atau gabungkan dengan keterangan lama siswa
            $keteranganBaru = "Alasan Ditolak: " . $request->alasan_penolakan;
            if ($peminjaman->keterangan) {
                $keteranganBaru .= " (Ket Awal: " . $peminjaman->keterangan . ")";
            }

            // Update status dan masukkan ke kolom keterangan
            $peminjaman->update([
                'status' => 'ditolak',
                'keterangan' => $keteranganBaru
            ]);

            return redirect()->back()->with('success', 'Peminjaman berhasil ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menolak peminjaman: ' . $e->getMessage());
        }
    }
    public function returnItem($id)
    {
        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::with('details')->where('id', $id)->where('prodi_id', Auth::user()->prodi_id)->firstOrFail();

            if ($peminjaman->status != 'dipinjam') {
                return redirect()->back()->with('error', 'Barang belum berstatus dipinjam.');
            }

            // Ubah status menjadi selesai
            $peminjaman->update(['status' => 'selesai']);

            // Kembalikan 'jumlah_tersedia' di tabel barang karena sudah dikembalikan ke lab
            foreach ($peminjaman->details as $detail) {
                $barang = Barang::findOrFail($detail->barang_id);
                $barang->increment('jumlah_tersedia', $detail->jumlah);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Barang berhasil dikembalikan. Stok telah ditambahkan kembali.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
