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
            // 0 = Pending, 1 = Verified, 2 = Revision
            $table->tinyInteger('status_spv')->default(0)->after('pic_qc_spv');
            $table->text('catatan_spv')->nullable()->after('status_spv');
            
            // DISESUAIKAN DENGAN GAMBAR ANDA
            $table->string('verified_by')->nullable()->after('catatan_spv'); 
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loading_checks', function (Blueprint $table) {
            // DISESUAIKAN DENGAN GAMBAR ANDA
            $table->dropColumn(['status_spv', 'catatan_spv', 'verified_by', 'verified_at']);
        });
    }
};