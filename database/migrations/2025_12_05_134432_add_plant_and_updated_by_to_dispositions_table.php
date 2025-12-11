<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dispositions', function (Blueprint $table) {
            // Cek jika kolom belum ada agar tidak error "Duplicate column"
            if (!Schema::hasColumn('dispositions', 'plant_uuid')) {
                $table->string('plant_uuid')->nullable()->after('catatan');
            }

            if (!Schema::hasColumn('dispositions', 'updated_by')) {
                // Gunakan string. Jangan pasang foreign key dulu agar migrasi lancar.
                $table->string('updated_by')->nullable()->after('created_by');
                
                // BARIS INI KITA KOMENTARI DULU (Penyebab Error 3780)
                // $table->foreign('updated_by')->references('id')->on('users');
            }
        });
    }

    public function down()
    {
        Schema::table('dispositions', function (Blueprint $table) {
            // Hapus kolom saja
            $table->dropColumn(['plant_uuid', 'updated_by']);
        });
    }
};