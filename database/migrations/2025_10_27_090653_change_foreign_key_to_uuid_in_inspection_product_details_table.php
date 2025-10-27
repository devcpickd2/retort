<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('inspection_product_details', function (Blueprint $table) {
            
            // 1. CEK DULU: Apakah kolom 'id' yang lama masih ada?
            if (Schema::hasColumn('inspection_product_details', 'raw_material_inspection_id')) {
                // Jika masih ada, hapus constraint dan kolomnya
                $table->dropForeign(['raw_material_inspection_id']); 
                $table->dropColumn('raw_material_inspection_id');
            }

            // 2. CEK DULU: Apakah kolom 'uuid' yang baru BELUM ada?
            if (!Schema::hasColumn('inspection_product_details', 'raw_material_inspection_uuid')) {
                // Jika belum ada, tambahkan kolom dan constraint baru
                $table->uuid('raw_material_inspection_uuid')->after('uuid')->nullable();
                
                $table->foreign('raw_material_inspection_uuid')
                      ->references('uuid')
                      ->on('raw_material_inspections')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspection_product_details', function (Blueprint $table) {
            
            // 1. CEK DULU: Apakah kolom 'uuid' yang baru ada?
            if (Schema::hasColumn('inspection_product_details', 'raw_material_inspection_uuid')) {
                // Jika ada, hapus
                $table->dropForeign(['raw_material_inspection_uuid']);
                $table->dropColumn('raw_material_inspection_uuid');
            }
            
            // 2. CEK DULU: Apakah kolom 'id' yang lama BELUM ada?
            if (!Schema::hasColumn('inspection_product_details', 'raw_material_inspection_id')) {
                // Jika belum ada, buat kembali
                $table->foreignId('raw_material_inspection_id')
                      ->nullable() // Buat nullable agar aman
                      ->constrained('raw_material_inspections')
                      ->onDelete('cascade');
            }
        });
    }
};