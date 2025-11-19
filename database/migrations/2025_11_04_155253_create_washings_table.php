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
        Schema::create('washings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->date('date');
            $table->string('plant');
            $table->string('shift');
            $table->string('nama_produk');
            $table->string('kode_produksi');
            $table->time('pukul');
            $table->decimal('panjang_produk', 8, 2)->nullable();
            $table->decimal('diameter_produk', 8, 2)->nullable();
            $table->string('airtrap')->nullable();
            $table->string('lengket')->nullable();
            $table->string('sisa_adonan')->nullable();
            $table->string('kebocoran')->nullable();
            $table->string('kekuatan_seal')->nullable();
            $table->string('print_kode')->nullable();
            $table->decimal('konsentrasi_pckleer', 8, 2)->nullable();
            $table->decimal('suhu_pckleer_1', 8, 2)->nullable();
            $table->decimal('suhu_pckleer_2', 8, 2)->nullable();
            $table->decimal('ph_pckleer', 8, 2)->nullable();
            $table->string('kondisi_air_pckleer')->nullable();
            $table->decimal('konsentrasi_pottasium', 8, 2)->nullable();
            $table->decimal('suhu_pottasium', 8, 2)->nullable();
            $table->decimal('ph_pottasium', 8, 2)->nullable();
            $table->string('kondisi_pottasium')->nullable();
            $table->decimal('suhu_heater', 8, 2)->nullable();
            $table->decimal('speed_1', 8, 2)->nullable();
            $table->decimal('speed_2', 8, 2)->nullable();
            $table->decimal('speed_3', 8, 2)->nullable();
            $table->decimal('speed_4', 8, 2)->nullable();
            $table->string('catatan')->nullable();
            $table->string('nama_produksi')->nullable();
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
        Schema::dropIfExists('washings');
    }
};
