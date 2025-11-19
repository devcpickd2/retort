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
        Schema::create('labelisasi_pvdcs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->string('username');
            $table->string('username_updated');
            $table->date('date');
            $table->string('plant');
            $table->string('shift');
            $table->string('nama_produk');
            $table->longText('labelisasi')->nullable();
            $table->string('nama_operator');
            $table->string('status_operator')->nullable();
            $table->timestamp('tgl_update_operator')->nullable();
            $table->string('nama_spv')->nullable();
            $table->string('status_spv')->nullable();
            $table->string('catatan_spv')->nullable();
            $table->timestamp('tgl_update_spv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labelisasi_pvdcs');
    }
};
