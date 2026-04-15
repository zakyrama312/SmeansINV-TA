<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Permintaan;
use App\Models\Kondisi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $prodiId = Auth::user()->prodi_id;

        // 1. STATISTIK KARTU ATAS
        $totalBarang = Barang::where('prodi_id', $prodiId)->sum('stok'); // Total fisik barang
        $peminjamanAktif = Peminjaman::where('prodi_id', $prodiId)->where('status', 'dipinjam')->count();
        $peminjamanPending = Peminjaman::where('prodi_id', $prodiId)->where('status', 'pending')->count();
        $permintaanPending = Permintaan::where('prodi_id', $prodiId)->where('status', 'pending')->count();

        // 2. DATA GRAFIK 1: TRANSAKSI 6 BULAN TERAKHIR
        $months = [];
        $peminjamanData = [];
        $permintaanData = [];

        // Looping 6 bulan ke belakang
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->translatedFormat('M Y'); // Contoh: "Apr 2026"

            $peminjamanData[] = Peminjaman::where('prodi_id', $prodiId)
                ->whereMonth('tanggal_pinjam', $date->month)
                ->whereYear('tanggal_pinjam', $date->year)
                ->count();

            $permintaanData[] = Permintaan::where('prodi_id', $prodiId)
                ->whereMonth('tanggal_permintaan', $date->month)
                ->whereYear('tanggal_permintaan', $date->year)
                ->count();
        }

        // 3. DATA GRAFIK 2: KONDISI BARANG (Donut Chart)
        $kondisis = Kondisi::where('prodi_id', $prodiId)->get();
        $kondisiLabels = [];
        $kondisiData = [];

        foreach ($kondisis as $k) {
            $count = Barang::where('prodi_id', $prodiId)->where('kondisi_id', $k->id)->count();
            if ($count > 0) { // Hanya tampilkan kondisi yang ada barangnya
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
