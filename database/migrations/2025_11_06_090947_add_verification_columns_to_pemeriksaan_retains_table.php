<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pemeriksaan_retains', function (Blueprint $table) {
            // 0 = Pending, 1 = Verified, 2 = Revision
            $table->tinyInteger('status_spv')->default(0)->after('keterangan'); 
            $table->text('catatan_spv')->nullable()->after('status_spv');
            $table->foreignUuid('verified_by')->nullable()->constrained('users', 'uuid')->after('catatan_spv');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }
    public function down(): void {
        Schema::table('pemeriksaan_retains', function (Blueprint $table) {
            $table->dropColumn(['status_spv', 'catatan_spv', 'verified_by', 'verified_at']);
        });
    }
};