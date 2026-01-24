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
        Schema::create('penyimpangan_kualitas', function (Blueprint $table) {
            // == PERSYARATAN UTAMA ==
            $table->id(); // PK: id
            $table->uuid('uuid')->unique(); // Unique Key: uuid

            // == DATA DARI FORM HEADER ==
            $table->string('nomor');
            $table->date('tanggal');
            $table->string('ditujukan_untuk');

            // == DATA DARI FORM TABEL ==
            $table->string('nama_produk');
            $table->string('lot_kode')->nullable();
            $table->string('jumlah')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('penyelesaian')->nullable();

            // == VERIFIKASI (2 TAHAP) ==
            // Tahap 1: Diketahui Oleh
            $table->tinyInteger('status_diketahui')->default(0)->comment('0:Pending, 1:Verified, 2:Revision');
            $table->text('catatan_diketahui')->nullable();
            $table->uuid('diketahui_by')->nullable();
            $table->timestamp('diketahui_at')->nullable();

            // Tahap 2: Disetujui Oleh
            $table->tinyInteger('status_disetujui')->default(0)->comment('0:Pending, 1:Verified, 2:Revision');
            $table->text('catatan_disetujui')->nullable();
            $table->uuid('disetujui_by')->nullable();
            $table->timestamp('disetujui_at')->nullable();
            
            // == AUDIT & TIMESTAMPS ==
            $table->uuid('created_by')->nullable(); // Created By
            $table->timestamps();
            $table->softDeletes(); // Soft Deletes

            // == FOREIGN KEY CONSTRAINTS ==
            $table->foreign('created_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('diketahui_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('disetujui_by')->references('uuid')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyimpangan_kualitas');
    }
};