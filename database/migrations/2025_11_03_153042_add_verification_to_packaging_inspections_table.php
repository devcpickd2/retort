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
        // Mengubah tabel 'packaging_inspections' yang sudah ada
        Schema::table('packaging_inspections', function (Blueprint $table) {
            // Kolom untuk verifikasi SPV
            $table->tinyInteger('status_spv')->default(0)->after('shift'); // 0 = Pending, 1 = Verified, 2 = Revision
            $table->text('catatan_spv')->nullable()->after('status_spv');
            $table->foreignId('verified_by')->nullable()->after('catatan_spv')->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packaging_inspections', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['status_spv', 'catatan_spv', 'verified_by', 'verified_at']);
        });
    }
};
