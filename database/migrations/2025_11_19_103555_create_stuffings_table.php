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
        Schema::create('stuffings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->date('date');
            $table->string('plant');
            $table->string('shift');
            $table->string('nama_produk');
            $table->string('kode_produksi');
            $table->date('exp_date');
            $table->string('kode_mesin');
            $table->time('jam_mulai');
            $table->decimal('suhu', 8, 2)->nullable();
            $table->string('sensori')->nullable();
            $table->decimal('kecepatan_stuffing', 8, 2)->nullable();
            $table->decimal('panjang_pcs', 8, 2)->nullable();
            $table->decimal('berat_pcs', 8, 2)->nullable();
            $table->string('cek_vakum')->nullable();
            $table->string('kebersihan_seal')->nullable();
            $table->string('kekuatan_seal')->nullable();
            $table->decimal('diameter_klip', 8, 2)->nullable();
            $table->string('print_kode')->nullable();
            $table->decimal('lebar_cassing', 8, 2)->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('stuffings');
    }
};
