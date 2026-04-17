<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
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
        $user = Auth::user();

        // ========================================================
        // LOGIKA UNTUK DASHBOARD SISWA / PEMINJAM
        // ========================================================
        if ($user->role === 'peminjam') {
            // Asumsi: Kita mencocokkan nama_peminjam dengan nama user yang login
            // (Jika kamu punya kolom user_id di tabel peminjaman, gunakan where('user_id', $user->id) )

            $pinjamanAktif = Peminjaman::with('details.barang')
                ->where('nama_peminjam', $user->name)
                ->where('status', 'dipinjam')
                ->get();

            $pinjamanPending = Peminjaman::where('nama_peminjam', $user->name)->where('status', 'pending')->count();
            $permintaanPending = Permintaan::where('nama_peminta', $user->name)->where('status', 'pending')->count();

            return view('dashboard-peminjam', compact('pinjamanAktif', 'pinjamanPending', 'permintaanPending'));
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
            $date = Carbon::now()->subMonths($i);
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

        // Arahkan ke file view dashboard utama (dashboard.blade.php)
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
