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
        Schema::create('sampling_fgs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->date('date');
            $table->string('plant');
            $table->string('shift');
            $table->string('palet');
            $table->string('nama_produk');
            $table->string('kode_produksi');
            $table->date('exp_date');
            $table->time('pukul');
            $table->string('kalibrasi')->nullable();
            $table->integer('berat_produk')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('isi_per_box')->nullable();
            $table->string('kemasan')->nullable();
            $table->integer('jumlah_box')->nullable();
            $table->integer('release')->nullable();
            $table->integer('reject')->nullable();
            $table->integer('hold')->nullable();
            $table->string('item_mutu')->nullable();
            $table->string('catatan')->nullable();
            $table->string('nama_koordinator')->nullable();
            $table->string('status_koordinator')->nullable();
            $table->timestamp('tgl_update_koordinator')->nullable();
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
        Schema::dropIfExists('sampling_fgs');
    }
};
