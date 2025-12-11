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
        Schema::table('labelisasi_pvdcs', function (Blueprint $table) {
            // Ubah kolom menjadi nullable agar tidak error saat insert data baru
            $table->string('username_updated')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('labelisasi_pvdcs', function (Blueprint $table) {
            // Kembalikan ke pengaturan awal (Wajib isi / Not Null)
            // Hati-hati: Rollback akan gagal jika ada data yang nilainya NULL
            $table->string('username_updated')->nullable(false)->change();
        });
    }
};