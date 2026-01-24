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
        // Nama tabel diubah menjadi 'pemeriksaan_kekuatan_magnet_traps'
        Schema::create('pemeriksaan_kekuatan_magnet_traps', function (Blueprint $table) {
            // == PERSYARATAN UTAMA ==
            $table->id(); // PK: id
            $table->uuid('uuid')->unique(); // Unique Key: uuid

            // == DATA DARI FORM ==
            $table->date('tanggal');
            
            // Kekuatan Medan Magnet (Gauss)
            $table->decimal('kekuatan_median_1', 8, 2)->nullable();
            $table->decimal('kekuatan_median_2', 8, 2)->nullable();
            $table->decimal('kekuatan_median_3', 8, 2)->nullable();

            // Parameter Setingan (Sesuai √ / Tidak Sesuai X)
            $table->boolean('parameter_sesuai')->default(true); 

            // Kondisi Magnet Trap (Visual)
            $table->string('kondisi_magnet_trap')->nullable();
            
            $table->text('keterangan')->nullable();

            // Petugas
            $table->string('petugas_qc')->nullable();
            $table->string('petugas_eng')->nullable();

            // == VERIFIKASI (SPV QC) ==
            $table->tinyInteger('status_spv')->default(0)->comment('0:Pending, 1:Verified, 2:Revision');
            $table->text('catatan_spv')->nullable();
            $table->uuid('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            
            // == AUDIT & TIMESTAMPS ==
            $table->uuid('created_by')->nullable(); // Created By
            $table->timestamps();
            $table->softDeletes(); // Soft Deletes

            // == FOREIGN KEY CONSTRAINTS ==
            $table->foreign('created_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('verified_by')->references('uuid')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_kekuatan_magnet_traps');
    }
};