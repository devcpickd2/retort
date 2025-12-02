<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan Facade DB

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pemeriksaan_retains', function (Blueprint $table) {
            // 1. Plant UUID (Cek dulu apakah kolom sudah ada)
            if (!Schema::hasColumn('pemeriksaan_retains', 'plant_uuid')) {
                $table->string('plant_uuid')->nullable()->after('keterangan')->index();
            }

            // 2. Created By
            if (!Schema::hasColumn('pemeriksaan_retains', 'created_by')) {
                // Jika belum ada, buat baru sebagai string
                $table->string('created_by')->nullable()->after('plant_uuid');
                $table->foreign('created_by')->references('uuid')->on('users')->onDelete('set null');
            } else {
                // [PENTING] Jika sudah ada (misal tipe Integer), kita UBAH ke String agar support UUID.
                // Kita gunakan raw statement agar aman jika tidak ada doctrine/dbal.
                // Pastikan database Anda MySQL/MariaDB.
                try {
                    DB::statement('ALTER TABLE pemeriksaan_retains MODIFY COLUMN created_by VARCHAR(255) NULL');
                } catch (\Exception $e) {
                    // Abaikan jika gagal (misal bukan MySQL), user harus ubah manual
                }
            }

            // 3. Updated By (Cek dulu apakah kolom sudah ada)
            if (!Schema::hasColumn('pemeriksaan_retains', 'updated_by')) {
                $table->string('updated_by')->nullable()->after('created_by');
                $table->foreign('updated_by')->references('uuid')->on('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemeriksaan_retains', function (Blueprint $table) {
            // Cek keberadaan kolom sebelum mencoba menghapusnya
            if (Schema::hasColumn('pemeriksaan_retains', 'created_by')) {
                // Hapus foreign key jika ada (nama constraint mungkin berbeda jika dibuat manual, jadi gunakan try-catch atau array syntax)
                try {
                    $table->dropForeign(['created_by']);
                } catch (\Exception $e) {}
                
                // Jangan drop column created_by jika itu kolom asli bawaan tabel,
                // tapi jika ini tracking tambahan, bisa di-drop.
                // Untuk aman, kita biarkan atau kembalikan ke integer (opsional).
                // $table->dropColumn('created_by'); 
            }

            if (Schema::hasColumn('pemeriksaan_retains', 'updated_by')) {
                try {
                    $table->dropForeign(['updated_by']);
                } catch (\Exception $e) {}
                $table->dropColumn('updated_by');
            }

            if (Schema::hasColumn('pemeriksaan_retains', 'plant_uuid')) {
                $table->dropColumn('plant_uuid');
            }
        });
    }
};