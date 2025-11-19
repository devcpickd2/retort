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
        Schema::create('samplings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); 
            $table->string('username');
            $table->string('username_updated')->nullable();
            $table->date('date');
            $table->string('plant');
            $table->string('shift');
            $table->string('jenis_sampel');
            $table->string('jenis_kemasan');
            $table->string('nama_produk');
            $table->string('kode_produksi');
            $table->decimal('jumlah', 8, 2)->nullable();
            $table->decimal('jamur', 8, 2)->nullable();
            $table->decimal('lendir', 8, 2)->nullable();
            $table->decimal('klip_tajam', 8, 2)->nullable();
            $table->decimal('pin_hole', 8, 2)->nullable();
            $table->decimal('air_trap_pvdc', 8, 2)->nullable();
            $table->decimal('air_trap_produk', 8, 2)->nullable();
            $table->decimal('keriput', 8, 2)->nullable();
            $table->decimal('bengkok', 8, 2)->nullable();
            $table->decimal('non_kode', 8, 2)->nullable();
            $table->decimal('over_lap', 8, 2)->nullable();
            $table->decimal('kecil', 8, 2)->nullable();
            $table->decimal('terjepit', 8, 2)->nullable();
            $table->decimal('double_klip', 8, 2)->nullable();
            $table->decimal('seal_halus', 8, 2)->nullable();
            $table->decimal('basah', 8, 2)->nullable();
            $table->decimal('dll', 8, 2)->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('samplings');
    }
};
