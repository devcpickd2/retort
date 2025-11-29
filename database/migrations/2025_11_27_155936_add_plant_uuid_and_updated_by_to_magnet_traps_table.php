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
        Schema::table('magnet_traps', function (Blueprint $table) {
            // Menambahkan kolom plant_uuid
            // Menggunakan nullable() agar jika ada data lama, tidak error
            // after('created_by') hanya untuk merapikan urutan kolom (opsional)
            $table->string('plant_uuid')->nullable()->after('created_by');

            // Menambahkan kolom updated_by
            $table->string('updated_by')->nullable()->after('plant_uuid');
            
            // OPSIONAL: Jika ingin menambahkan index agar pencarian lebih cepat
            // $table->index('plant_uuid');
            // $table->index('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('magnet_traps', function (Blueprint $table) {
            // Menghapus kolom jika di-rollback
            $table->dropColumn(['plant_uuid', 'updated_by']);
        });
    }
};