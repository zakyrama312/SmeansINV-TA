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
        Schema::table('users', function (Blueprint $table) {
            $table->string('kelas')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('role', ['teknisi', 'peminjam', 'kaprodi'])->default('peminjam');
            // Relasi ke prodi agar user/siswa/teknisi terikat pada prodi tertentu
            $table->foreignId('prodi_id')->nullable()->constrained('prodis')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
