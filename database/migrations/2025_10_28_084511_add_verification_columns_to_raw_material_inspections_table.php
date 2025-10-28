<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Menambahkan kolom baru ke tabel 'raw_material_inspections' yang sudah ada
        Schema::table('raw_material_inspections', function (Blueprint $table) {
            
            /**
             * Kolom untuk status verifikasi SPV.
             * 0 = Pending (Default)
             * 1 = Verified
             * 2 = Revision
             */
            $table->tinyInteger('status_spv')->default(0)->comment('0: Pending, 1: Verified, 2: Revision');
            
            /**
             * Kolom untuk catatan dari SPV, terutama jika statusnya 'Revision'.
             */
            $table->text('catatan_spv')->nullable();
            
            /**
             * Kolom untuk menyimpan UUID dari SPV yang melakukan verifikasi.
             * Dibuat nullable karena awalnya kosong.
             * Menggunakan ->uuid() asumsi tabel 'users' Anda juga menggunakan UUID sebagai primary key.
             * Jika tabel 'users' Anda menggunakan 'id' (integer), ganti ->uuid() menjadi ->foreignId() atau ->unsignedBigInteger().
             */
            $table->uuid('verified_by_spv_uuid')->nullable();
            
            /**
             * Kolom untuk menyimpan kapan data diverifikasi.
             */
            $table->timestamp('verified_at_spv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('raw_material_inspections', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn([
                'status_spv',
                'catatan_spv',
                'verified_by_spv_uuid',
                'verified_at_spv'
            ]);
        });
    }
};
