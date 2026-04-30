<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\DetailPermintaan;
use App\Models\Peminjaman;
use App\Models\Permintaan;
use App\Models\Kondisi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ========================================================
        // LOGIKA UNTUK DASHBOARD SISWA / PEMINJAM
        // ========================================================
        if ($user->role === 'peminjam') {
            // 1. Tarik Peminjaman Alat yang sedang dipinjam
            $pinjamanAktif = Peminjaman::with('details.barang')
                ->where('prodi_id', $user->prodi_id)
                ->where('status', 'dipinjam')
                ->get();

            // 2. Tarik Bahan Habis Pakai yang statusnya Belum Habis
            $bahanAktif = DetailPermintaan::with(['barang', 'permintaan'])
                ->where('status_penggunaan', 'belum_habis')
                ->whereHas('permintaan', function ($q) use ($user) {
                    $q->where('prodi_id', $user->prodi_id)
                        ->where('status', 'disetujui'); // Hanya tampil kalau sudah di-ACC Admin
                })->latest()->get();

            // 3. Hitung jumlah pengajuan yang masih pending
            $pinjamanPending = Peminjaman::where('prodi_id', $user->prodi_id)->where('status', 'pending')->count();
            $permintaanPending = Permintaan::where('prodi_id', $user->prodi_id)->where('status', 'pending')->count();

            // PASTIKAN $bahanAktif ADA DI DALAM COMPACT DI BAWAH INI:
            return view('dashboard-peminjam', compact('pinjamanAktif', 'bahanAktif', 'pinjamanPending', 'permintaanPending'));
        }


        // ========================================================
        // LOGIKA UNTUK DASHBOARD ADMIN & KAPRODI
        // ========================================================
        $prodiId = $user->prodi_id;

        $totalBarang = Barang::where('prodi_id', $prodiId)->sum('stok');
        $peminjamanAktif = Peminjaman::where('prodi_id', $prodiId)->where('status', 'dipinjam')->count();
        $peminjamanPending = Peminjaman::where('prodi_id', $prodiId)->where('status', 'pending')->count();
        $permintaanPending = Permintaan::where('prodi_id', $prodiId)->where('status', 'pending')->count();

        $months = [];
        $peminjamanData = [];
        $permintaanData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->startOfMonth()->subMonths($i);
            $months[] = $date->translatedFormat('M Y');

            $peminjamanData[] = Peminjaman::where('prodi_id', $prodiId)
                ->whereMonth('tanggal_pinjam', $date->month)
                ->whereYear('tanggal_pinjam', $date->year)
                ->count();

            $permintaanData[] = Permintaan::where('prodi_id', $prodiId)
                ->whereMonth('tanggal_permintaan', $date->month)
                ->whereYear('tanggal_permintaan', $date->year)
                ->count();
        }

        $kondisis = Kondisi::where('prodi_id', $prodiId)->get();
        $kondisiLabels = [];
        $kondisiData = [];

        foreach ($kondisis as $k) {
            $count = Barang::where('prodi_id', $prodiId)->where('kondisi_id', $k->id)->count();
            if ($count > 0) {
                $kondisiLabels[] = $k->nama_kondisi;
                $kondisiData[] = $count;
            }
        }

        return view('dashboard', compact(
            'totalBarang',
            'peminjamanAktif',
            'peminjamanPending',
            'permintaanPending',
            'months',
            'peminjamanData',
            'permintaanData',
            'kondisiLabels',
            'kondisiData'
        ));
    }
}
