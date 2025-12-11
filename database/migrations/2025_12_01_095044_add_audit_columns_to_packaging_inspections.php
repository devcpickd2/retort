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
        Schema::table('packaging_inspections', function (Blueprint $table) {
            // 1. Plant UUID (Tetap String)
            $table->string('plant_uuid')->nullable()->after('shift')->index();

            // 2. Created By & Updated By (UBAH JADI STRING/UUID)
            // Kita ubah dari unsignedBigInteger menjadi string karena akan menampung UUID
            $table->string('created_by')->nullable()->after('plant_uuid');
            $table->string('updated_by')->nullable()->after('created_by');

            // 3. Foreign Keys
            // Perhatikan: references('uuid') mengarah ke kolom 'uuid' di tabel users
            $table->foreign('created_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('uuid')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packaging_inspections', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['plant_uuid', 'created_by', 'updated_by']);
        });
    }
};