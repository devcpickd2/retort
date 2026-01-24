<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;  // <-- PENTING: Tambahkan ini
use Illuminate\Support\Str;       // <-- PENTING: Tambahkan ini

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Bagian 1: Menambahkan kolom verifikasi (kode asli Anda)
        Schema::table('magnet_traps', function (Blueprint $table) {
            // 0=Pending, 1=Verified, 2=Revision
            $table->tinyInteger('status_spv')->default(0)->after('engineer_id');
            $table->text('catatan_spv')->nullable()->after('status_spv');
            $table->uuid('verified_by_spv_uuid')->nullable()->after('catatan_spv');
            $table->timestamp('verified_at_spv')->nullable()->after('verified_by_spv_uuid');
        });

        // Bagian 2: Memperbaiki dan mengisi data UUID yang kosong
        // Skrip ini akan mencari semua baris yang uuid-nya NULL dan mengisinya
        $recordsToUpdate = DB::table('magnet_traps')->whereNull('uuid')->cursor();

        foreach ($recordsToUpdate as $record) {
            DB::table('magnet_traps')
              ->where('id', $record->id)
              ->update(['uuid' => Str::uuid()]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('magnet_traps', function (Blueprint $table) {
            $table->dropColumn(['status_spv', 'catatan_spv', 'verified_by_spv_uuid', 'verified_at_spv']);
        });
    }
};