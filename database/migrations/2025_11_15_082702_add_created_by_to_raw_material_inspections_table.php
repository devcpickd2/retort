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
        Schema::table('raw_material_inspections', function (Blueprint $table) {
            // Kita asumsikan tabel 'users' Anda menggunakan UUID sebagai primary key
            // berdasarkan kolom 'verified_by_spv_uuid' Anda.
            $table->foreignUuid('created_by_uuid')
                  ->nullable()
                  ->after('uuid') // Anda bisa letakkan di mana saja
                  ->constrained('users', 'uuid') // Sesuuaikan 'users' dan 'uuid' jika nama tabel/key Anda berbeda
                  ->nullOnDelete(); // Jika user dihapus, set kolom ini jadi NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raw_material_inspections', function (Blueprint $table) {
            // Drop foreign key constraint terlebih dahulu
            $table->dropForeign(['created_by_uuid']);
            // Kemudian drop kolomnya
            $table->dropColumn('created_by_uuid');
        });
    }
};