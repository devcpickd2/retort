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
            // Cek dulu apakah kolom sudah ada untuk menghindari error "Column already exists"
            if (!Schema::hasColumn('loading_checks', 'plant_uuid')) {
                $table->string('plant_uuid')->nullable()->after('uuid');
            }
            
            if (!Schema::hasColumn('loading_checks', 'updated_by')) {
                $table->string('updated_by')->nullable()->after('plant_uuid');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loading_checks', function (Blueprint $table) {
            $table->dropColumn(['plant_uuid', 'updated_by']);
        });
    }
};
