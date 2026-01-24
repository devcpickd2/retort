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
        Schema::create('withdrawls', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->date('date');
            $table->string('plant');
            $table->string('no_withdrawl');
            $table->string('nama_produk');
            $table->string('kode_produksi');
            $table->date('exp_date');
            $table->integer('jumlah_produksi')->nullable();
            $table->integer('jumlah_edar')->nullable();
            $table->date('tanggal_edar')->nullable();
            $table->integer('jumlah_tarik')->nullable();
            $table->date('tanggal_tarik')->nullable();
            $table->longText('rincian')->nullable();
            $table->string('nama_manager')->nullable();
            $table->string('status_manager')->nullable();
            $table->string('catatan_manager')->nullable();
            $table->timestamp('tgl_update_manager')->nullable();
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
        Schema::dropIfExists('withdrawls');
    }
};
