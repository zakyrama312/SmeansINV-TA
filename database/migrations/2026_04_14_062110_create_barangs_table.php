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
        // create_barangs_table
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->text('deskripsi')->nullable();
            $table->string('merk')->nullable();
            $table->string('foto')->nullable(); // path foto
            $table->string('foto_thumbnail')->nullable(); // path thumbnail
            $table->integer('stok')->default(0);
            $table->integer('jumlah_tersedia')->default(0); // barang tersedia (tidak dipinjam)
            // Relasi menggunakan restrictOnDelete agar data master yang terpakai tidak bisa dihapus sembarangan
            $table->foreignId('prodi_id')->constrained('prodis')->restrictOnDelete();
            $table->foreignId('kategori_id')->constrained('kategoris')->restrictOnDelete();
            $table->foreignId('ruang_id')->constrained('ruangs')->restrictOnDelete();
            $table->foreignId('kondisi_id')->constrained('kondisis')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
