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
        Schema::table('barangs', function (Blueprint $table) {
            // Menambahkan kolom tahun_pembuatan setelah kolom merk.
            // Kita pakai tipe string/integer 4 digit dan boleh kosong (nullable)
            $table->string('tahun_pembuatan', 4)->nullable()->after('merk');
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn('tahun_pembuatan');
        });
    }
};
