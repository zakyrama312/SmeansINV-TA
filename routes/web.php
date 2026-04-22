<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanPeminjamanController;
use App\Http\Controllers\LaporanPermintaanController;
use App\Http\Controllers\LaporanRuangController;
use App\Http\Controllers\PeminjamanController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kelola Pengguna (Users)
    Route::resource('users', \App\Http\Controllers\UserController::class)->except(['show']);

    // peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');

    // Route untuk Aksi Tombol Validasi
    Route::patch('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::patch('/peminjaman/{id}/return', [PeminjamanController::class, 'returnItem'])->name('peminjaman.return');
    Route::patch('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

    // Route Permintaan Barang Habis Pakai
    Route::get('/permintaan', [App\Http\Controllers\PermintaanController::class, 'index'])->name('permintaan.index');
    Route::get('/permintaan/create', [App\Http\Controllers\PermintaanController::class, 'create'])->name('permintaan.create');
    Route::post('/permintaan', [App\Http\Controllers\PermintaanController::class, 'store'])->name('permintaan.store');
    Route::patch('/permintaan/{id}/approve', [App\Http\Controllers\PermintaanController::class, 'approve'])->name('permintaan.approve');
    Route::patch('/permintaan/{id}/reject', [App\Http\Controllers\PermintaanController::class, 'reject'])->name('permintaan.reject');
    Route::patch('/permintaan/lapor-habis/{id}', [App\Http\Controllers\PermintaanController::class, 'laporHabis'])->name('permintaan.lapor_habis');

    // Route Barang
    Route::resource('barang', BarangController::class);
    Route::get('/barang/detail/{kode_barang}', [BarangController::class, 'show'])->name('barang.show');
    Route::get('/barang/barcode/{kode_barang}', [BarangController::class, 'barcode'])->name('barang.barcode');

    // Laporan Data Ruang
    Route::get('/laporan/ruang/{slug}', [LaporanRuangController::class, 'show'])->name('laporan.ruang');
    Route::get('/laporan/ruang/{slug}/cetak', [LaporanRuangController::class, 'cetak'])->name('laporan.ruang.cetak');

    // Laporan Peminjaman
    Route::get('/laporan/peminjaman', [LaporanPeminjamanController::class, 'index'])->name('laporan.peminjaman');
    Route::get('/laporan/peminjaman/cetak', [LaporanPeminjamanController::class, 'cetak'])->name('laporan.peminjaman.cetak');
    Route::get('/laporan/peminjaman/excel', [LaporanPeminjamanController::class, 'excel'])->name('laporan.peminjaman.excel');

    // Laporan Permintaan
    Route::get('/laporan/permintaan', [LaporanPermintaanController::class, 'index'])->name('laporan.permintaan');
    Route::get('/laporan/permintaan/cetak', [LaporanPermintaanController::class, 'cetak'])->name('laporan.permintaan.cetak');
    Route::get('/laporan/permintaan/excel', [LaporanPermintaanController::class, 'excel'])->name('laporan.permintaan.excel');

    // Laporan Pemakaian
    Route::get('/laporan-pemakaian', [LaporanPermintaanController::class, 'laporanPemakaian'])->name('laporan.pemakaian');
    Route::get('/laporan-pemakaian/cetak', [LaporanPermintaanController::class, 'cetakPemakaian'])->name('laporan.pemakaian.cetak');
    Route::get('/laporan-pemakaian/excel', [LaporanPermintaanController::class, 'exportExcelPemakaian'])->name('laporan.pemakaian.excel');

    // Route Master Data
    Route::prefix('master')->group(function () {
        Route::resource('kategori', App\Http\Controllers\KategoriController::class)->except(['create', 'show', 'edit', 'update']);

        // Nanti duplikasi di sini untuk yang lain:
        Route::resource('prodi', App\Http\Controllers\ProdiController::class)->except(['create', 'show', 'edit', 'update']);
        Route::resource('ruang', App\Http\Controllers\RuangController::class)->except(['create', 'show', 'edit', 'update']);
        Route::resource('kondisi', App\Http\Controllers\KondisiController::class)->except(['create', 'show', 'edit', 'update']);
    });
});

require __DIR__ . '/auth.php';
