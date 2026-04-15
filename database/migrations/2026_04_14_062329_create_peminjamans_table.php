<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();

            // Kolom manual untuk identitas peminjam
            $table->string('nama_peminjam');
            $table->string('kelas')->nullable();
            $table->string('no_hp')->nullable();

            // Relasi prodi tetap ada agar data tidak bocor ke prodi lain
            $table->foreignId('prodi_id')->constrained('prodis')->restrictOnDelete();

            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali'); // Tambahan kolom baru
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'ditolak', 'dipinjam', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
