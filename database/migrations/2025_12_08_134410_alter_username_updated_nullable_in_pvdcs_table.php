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
        Schema::table('pvdcs', function (Blueprint $table) {
            // Mengubah kolom menjadi nullable
            $table->string('username_updated')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pvdcs', function (Blueprint $table) {
            // Mengembalikan kolom menjadi tidak boleh kosong (NOT NULL)
            // Hati-hati: Rollback akan gagal jika sudah ada data yang NULL di kolom ini
            $table->string('username_updated')->nullable(false)->change();
        });
    }
};