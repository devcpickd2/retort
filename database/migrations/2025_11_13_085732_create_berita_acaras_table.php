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
        Schema::create('berita_acaras', function (Blueprint $table) {
            // == PERSYARATAN UTAMA ==
            $table->id(); // 1. Primary Key: id
            $table->uuid('uuid')->unique(); // 2. Unique Key: uuid
            
            // == DATA DARI FORM (GAMBAR 1) ==
            $table->string('nomor')->unique()->comment('Nomor Berita Acara');
            $table->string('nama_barang');
            $table->string('jumlah_barang'); // String agar fleksibel (mis: "100 Pcs")
            $table->string('supplier');
            $table->text('uraian_masalah');
            
            $table->string('no_surat_jalan')->nullable();
            $table->string('dd_po')->nullable();
            $table->date('tanggal_kedatangan');
            
            // == KEPUTUSAN (CHECKBOXES) ==
            $table->boolean('keputusan_pengembalian')->default(false);
            $table->boolean('keputusan_potongan_harga')->default(false);
            $table->boolean('keputusan_sortir')->default(false);
            $table->boolean('keputusan_penukaran_barang')->default(false);
            $table->boolean('keputusan_penggantian_biaya')->default(false);
            $table->string('keputusan_lain_lain')->nullable();
            
            $table->date('tanggal_keputusan')->nullable();

            // == DIISI OLEH SUPPLIER ==
            $table->text('analisa_penyebab')->nullable();
            $table->text('tindak_lanjut_perbaikan')->nullable();

            // == LAMPIRAN (GAMBAR 2) ==
            // Bisa string (untuk 1 file) atau text/json (untuk banyak file)
            $table->text('lampiran')->nullable(); 

            // == VERIFIKASI (DARI CONTOH ANDA) ==
            // 'Dibuat Oleh' adalah created_by
            // 'Mengetahui: PPIC'
            $table->tinyInteger('status_ppic')->default(0)->comment('0:Pending, 1:Verified, 2:Revision');
            $table->text('catatan_ppic')->nullable();
            $table->uuid('ppic_verified_by')->nullable();
            $table->timestamp('ppic_verified_at')->nullable();

            // 'Disetujui Oleh: QC Supervisor'
            $table->tinyInteger('status_spv')->default(0)->comment('0:Pending, 1:Verified, 2:Revision');
            $table->text('catatan_spv')->nullable();
            $table->uuid('spv_verified_by')->nullable();
            $table->timestamp('spv_verified_at')->nullable();


            // == PERSYARATAN AUDIT & TIMESTAMPS ==
            $table->uuid('created_by')->nullable(); // 4. Created By (UUID)
            $table->timestamps();
            $table->softDeletes(); // 3. Soft Deletes

            // == FOREIGN KEY CONSTRAINTS ==
            // Asumsi tabel 'users' Anda memiliki kolom 'uuid'
            $table->foreign('created_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('ppic_verified_by')->references('uuid')->on('users')->onDelete('set null');
            $table->foreign('spv_verified_by')->references('uuid')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acaras');
    }
};