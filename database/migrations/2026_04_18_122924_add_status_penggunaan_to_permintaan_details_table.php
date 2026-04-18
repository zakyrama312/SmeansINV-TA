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
        Schema::table('detail_permintaans', function (Blueprint $table) {
            // Tambahkan kolom status_penggunaan setelah kolom jumlah
            $table->string('status_penggunaan')->default('belum_habis')->after('jumlah');
        });
    }

    public function down(): void
    {
        Schema::table('detail_permintaans', function (Blueprint $table) {
            $table->dropColumn('status_penggunaan');
        });
    }
};
