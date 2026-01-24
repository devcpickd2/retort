<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('metals', function (Blueprint $table) {
            // Tambahkan kolom hanya jika belum ada
            if (!Schema::hasColumn('metals', 'nama_engineer')) {
                $table->string('nama_engineer')->nullable()->after('sus');
            }
            
            if (!Schema::hasColumn('metals', 'status_engineer')) {
                $table->integer('status_engineer')->default(0)->after('nama_engineer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('metals', function (Blueprint $table) {
            // Hapus kolom hanya jika kolom tersebut memang ada
            if (Schema::hasColumn('metals', 'status_engineer')) {
                $table->dropColumn('status_engineer');
            }

            if (Schema::hasColumn('metals', 'nama_engineer')) {
                $table->dropColumn('nama_engineer');
            }
        });
    }
};