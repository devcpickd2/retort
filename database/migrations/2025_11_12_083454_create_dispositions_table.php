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
        Schema::create('dispositions', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->uuid('uuid')->unique(); // Unique Key untuk URL/Relasi
            
            $table->string('nomor')->unique();
            $table->date('tanggal');
            $table->string('kepada');
            
            // 3 kolom boolean untuk 3 checkbox
            $table->boolean('disposisi_produk')->default(false);
            $table->boolean('disposisi_material')->default(false);
            $table->boolean('disposisi_prosedur')->default(false);
            
            $table->text('dasar_disposisi');
            $table->text('uraian_disposisi');
            $table->text('catatan')->nullable();

            // --- KOLOM VERIFIKASI (BARU) ---
            // 0 = Pending, 1 = Verified, 2 = Revision
            $table->tinyInteger('status_spv')->default(0)->comment('0:Pending, 1:Verified, 2:Revision');
            $table->text('catatan_spv')->nullable();
            $table->timestamp('verified_at')->nullable();

            // --- KOLOM RELASI (DIPERBAIKI) ---
            // Menggunakan UUID agar sesuai dengan tabel 'users'
            $table->uuid('created_by')->nullable();
            $table->uuid('verified_by')->nullable();
            
            $table->timestamps();
            $table->softDeletes(); // Kolom 'deleted_at'

            // --- FOREIGN KEY CONSTRAINTS (diletakkan di akhir) ---
            // Asumsi 'id' di tabel 'users' adalah UUID
             $table->foreign('created_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('verified_by')->references('uuid')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispositions');
    }
};