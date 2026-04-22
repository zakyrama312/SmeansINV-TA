<?php

namespace App\Http\Controllers;

use App\Models\DetailPermintaan;
use App\Models\Permintaan;
use Illuminate\Http\Request;
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

    public function laporanPemakaian(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;

        // Mulai query dasar
        $query = DetailPermintaan::with(['barang', 'permintaan'])
            ->where('status_penggunaan', 'habis')
            ->whereHas('permintaan', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            });

        // Logika Filter Tanggal (Dari & Sampai)
        if ($request->filled('start_date')) {
            $query->whereDate('updated_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('updated_at', '<=', $request->end_date);
        }

        // Eksekusi query
        $laporan = $query->orderBy('updated_at', 'desc')->paginate(10)->withQueryString();

        // Mengarah ke folder laporan sesuai strukturmu
        return view('laporan.laporan-pemakaian', compact('laporan'));
    }

    // Fungsi khusus untuk menampilkan halaman cetak blank
    public function cetakPemakaian(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;

        $query = DetailPermintaan::with(['barang', 'permintaan'])
            ->where('status_penggunaan', 'habis')
            ->whereHas('permintaan', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            });

        // Tetap tangkap filternya jika admin mencetak setelah memfilter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('updated_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('updated_at', '<=', $request->end_date);
        }

        $laporan = $query->orderBy('updated_at', 'desc')->get();

        return view('laporan.cetak-pemakaian', compact('laporan', 'request'));
    }
    // Fungsi untuk Export ke Excel (CSV)
    public function exportExcelPemakaian(Request $request)
    {
        $prodiId = auth()->user()->prodi_id;

        $query = DetailPermintaan::with(['barang', 'permintaan'])
            ->where('status_penggunaan', 'habis')
            ->whereHas('permintaan', function ($q) use ($prodiId) {
                $q->where('prodi_id', $prodiId);
            });

        // Tetap terapkan filter tanggal jika ada
        if ($request->filled('start_date')) {
            $query->whereDate('updated_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('updated_at', '<=', $request->end_date);
        }

        $laporan = $query->orderBy('updated_at', 'desc')->get();

        // Nama file otomatis beserta tanggal download
        $fileName = 'Laporan_Pemakaian_Bahan_Lab_' . date('Y-m-d_H-i') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Header kolom tabel di Excel
        $columns = ['No', 'Tanggal Pemakaian', 'Nama Siswa', 'Kelas', 'Nama Bahan', 'Jumlah Dipakai', 'Kode Transaksi'];

        $callback = function () use ($laporan, $columns) {
            $file = fopen('php://output', 'w');

            // Tambahkan BOM agar karakter khusus terbaca sempurna di Microsoft Excel
            fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

            fputcsv($file, $columns, ';'); // Menggunakan titik koma (;) agar langsung rapi jadi kolom di Excel versi Indonesia

            $no = 1;
            foreach ($laporan as $item) {
                $row = [
                    $no++,
                    $item->updated_at->format('d M Y - H:i'),
                    $item->permintaan->nama_peminta,
                    $item->permintaan->kelas ?? '-',
                    $item->barang->nama_barang ?? 'Barang Terhapus',
                    $item->jumlah,
                    $item->permintaan->kode_transaksi
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        // Lempar data ke browser untuk didownload
        return response()->stream($callback, 200, $headers);
    }
}
