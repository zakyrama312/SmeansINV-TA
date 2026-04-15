<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use Illuminate\Support\Facades\Auth;

class LaporanPermintaanController extends Controller
{
    // 1. Tampilan Web UI dengan Filter
    public function index(Request $request)
    {
        $query = Permintaan::with('details.barang')->where('prodi_id', Auth::user()->prodi_id);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_permintaan', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permintaans = $query->latest()->paginate(15);
        return view('laporan.permintaan', compact('permintaans'));
    }

    // 2. Tampilan Cetak / Save PDF
    public function cetak(Request $request)
    {
        $query = Permintaan::with('details.barang')->where('prodi_id', Auth::user()->prodi_id);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_permintaan', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permintaans = $query->latest()->get();
        return view('laporan.cetak-permintaan', compact('permintaans', 'request'));
    }

    // 3. Export Excel
    public function excel(Request $request)
    {
        $query = Permintaan::with('details.barang')->where('prodi_id', Auth::user()->prodi_id);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_permintaan', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permintaans = $query->latest()->get();

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Permintaan_Bahan_Lab.xls");

        return view('laporan.excel-permintaan', compact('permintaans', 'request'));
    }
}
