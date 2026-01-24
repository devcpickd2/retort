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
        Schema::table('loading_checks', function (Blueprint $table) {
            // Kita perlu doctrine/dbal untuk mengubah kolom
            // Jalankan: composer require doctrine/dbal
            
            // 1. Hapus foreign key 'created_by' yang lama (yang merujuk ke INT)
            // Asumsi nama foreign key defaultnya adalah loading_checks_created_by_foreign
            // Jika Anda memberi nama lain, sesuaikan.
            try {
                $table->dropForeign('loading_checks_created_by_foreign');
            } catch (\Exception $e) {
                // Abaikan jika foreign key tidak ada
            }

            // 2. Ubah tipe kolomnya dari BIGINT menjadi UUID (atau CHAR(36))
            // Kita gunakan string(36) agar cocok dengan UUID
            $table->string('created_by', 36)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loading_checks', function (Blueprint $table) {
            // Kembalikan ke bigint jika di-rollback
            $table->unsignedBigInteger('created_by')->change();
        });
    }
};