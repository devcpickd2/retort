<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // <-- 1. Tambahkan ini
use Illuminate\Support\Str;      // <-- 2. Tambahkan ini

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Langkah 1: Tambahkan kolom sebagai nullable dulu
        Schema::table('loading_details', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });

        // Langkah 2: Isi data UUID untuk semua baris yang sudah ada
        // Kita gunakan DB::table agar aman di dalam migrasi
        $details = DB::table('loading_details')->whereNull('uuid')->cursor();
        foreach ($details as $detail) {
            DB::table('loading_details')
                ->where('id', $detail->id)
                ->update(['uuid' => (string) Str::uuid()]);
        }

        // Langkah 3: Setelah semua diisi, ubah kolom menjadi non-nullable dan unik
        Schema::table('loading_details', function (Blueprint $table) {
            $table->uuid('uuid')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loading_details', function (Blueprint $table) {
            // Hapus kolom 'uuid' jika migrasi di-rollback
            $table->dropColumn('uuid');
        });
    }
};