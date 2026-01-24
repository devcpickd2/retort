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
        // Perintah untuk MENAMBAH kolom
        Schema::table('pemeriksaan_retain_items', function (Blueprint $table) {
            // Kita tambahkan kolom 'exp_date' setelah 'kode_produksi'
            // Dibuat nullable() agar data lama tidak error
            $table->date('exp_date')->nullable()->after('kode_produksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Perintah untuk MENGHAPUS kolom (jika rollback)
        Schema::table('pemeriksaan_retain_items', function (Blueprint $table) {
            $table->dropColumn('exp_date');
        });
    }
};