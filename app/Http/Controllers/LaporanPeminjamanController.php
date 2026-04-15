<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class LaporanPeminjamanController extends Controller
{
    // 1. Tampilan Web UI dengan Filter
    public function index(Request $request)
    {
        $query = Peminjaman::with('details.barang')->where('prodi_id', Auth::user()->prodi_id);

        // Filter Tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->latest()->paginate(15);
        return view('laporan.peminjaman', compact('peminjamans'));
    }

    // 2. Tampilan Cetak / Save PDF
    public function cetak(Request $request)
    {
        $query = Peminjaman::with('details.barang')->where('prodi_id', Auth::user()->prodi_id);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->latest()->get(); // Ambil semua data tanpa paginasi
        return view('laporan.cetak-peminjaman', compact('peminjamans', 'request'));
    }

    // 3. Export murni ke format Excel (.xls)
    public function excel(Request $request)
    {
        $query = Peminjaman::with('details.barang')->where('prodi_id', Auth::user()->prodi_id);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjamans = $query->latest()->get();

        // Paksa browser mendownload file sebagai Excel
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Peminjaman_Lab.xls");

        return view('laporan.excel-peminjaman', compact('peminjamans', 'request'));
    }
}
