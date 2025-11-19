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
        Schema::create('packings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->date('date');
            $table->string('plant');
            $table->string('shift');
            $table->string('nama_produk'); 
            $table->time('waktu'); 
            $table->string('kalibrasi'); 
            $table->string('qrcode'); 
            $table->string('kode_printing')->nullable();
            $table->string('kode_toples')->nullable();
            $table->string('kode_karton')->nullable(); 
            $table->decimal('suhu', 8, 2)->nullable();
            $table->decimal('speed', 8, 2)->nullable();
            $table->string('kondisi_segel')->nullable(); 
            $table->decimal('berat_toples', 8, 2)->nullable();
            $table->decimal('berat_pouch', 8, 2)->nullable();
            $table->string('no_lot')->nullable(); 
            $table->date('tgl_kedatangan')->nullable(); 
            $table->string('nama_supplier')->nullable(); 
            $table->string('keterangan')->nullable(); 
            $table->string('nama_produksi');
            $table->string('status_produksi')->nullable();
            $table->timestamp('tgl_update_produksi')->nullable();
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
        Schema::dropIfExists('packings');
    }
};
