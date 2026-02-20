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
        // Bagian 1: Drop kolom lama (termasuk jika sudah berbentuk JSON atau Decimal)
        Schema::table('mincings', function (Blueprint $table) {
            if (Schema::hasColumn('mincings', 'suhu_sebelum_grinding')) {
                $table->dropColumn('suhu_sebelum_grinding');
            }
        });

        // Bagian 2: Bikin ulang kolom sebagai JSON
        Schema::table('mincings', function (Blueprint $table) {
            $table->json('suhu_sebelum_grinding')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback: Hapus versi JSON, kembalikan ke bentuk Decimal asli
        Schema::table('mincings', function (Blueprint $table) {
            if (Schema::hasColumn('mincings', 'suhu_sebelum_grinding')) {
                $table->dropColumn('suhu_sebelum_grinding');
            }
        });

        Schema::table('mincings', function (Blueprint $table) {
            $table->decimal('suhu_sebelum_grinding', 8, 2)->nullable();
        });
    }
};