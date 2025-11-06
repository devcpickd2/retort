<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel master
        Schema::create('pemeriksaan_retains', function (Blueprint $table) {
            $table->id(); // <-- DIUBAH: Menjadi auto-increment BIGINT Primary Key
            $table->uuid('uuid')->unique(); // <-- DITAMBAH: Kolom UUID terpisah
            
            $table->string('hari');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            
            // Ini tetap benar, merujuk ke users.uuid
            $table->foreignUuid('created_by')
                  ->references('uuid') 
                  ->on('users');         
                  
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_retains');
    }
};