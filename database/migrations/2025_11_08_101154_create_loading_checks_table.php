<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loading_checks', function (Blueprint $table) {
            $table->id(); // Persyaratan: id sebagai PK
            $table->uuid('uuid')->unique(); // Persyaratan: uuid sebagai unique key
            
            $table->date('tanggal');
            $table->enum('shift', ['Pagi', 'Malam']);
            $table->enum('jenis_aktivitas', ['Loading', 'Unloading']);
            
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();

            $table->string('no_pol_mobil');
            $table->string('nama_supir');
            $table->string('ekspedisi');
            $table->string('tujuan_asal'); // Menggabungkan 'Tujuan' (image) dan 'Tujuan/Asal' (PDF)
            $table->string('no_segel')->nullable();
            $table->string('jenis_kendaraan')->nullable();

            // Untuk checklist 'Kondisi Mobil' dari PDF [sources 17-27]
            $table->json('kondisi_mobil')->nullable(); 

            // 'Keterangan' dari image (Varian & Jumlah Total)
            $table->text('keterangan_total')->nullable(); 
            // 'Keterangan' dari PDF (catatan umum)
            $table->text('keterangan_umum')->nullable(); 

            // Approval / PICs
            $table->string('pic_qc')->nullable(); // Diperiksa Oleh (QC)
            $table->string('pic_warehouse')->nullable(); // Diketahui Oleh (Warehouse / PIC WH)
            $table->string('pic_qc_spv')->nullable(); // Disetujui Oleh (QC SPV)

            // Persyaratan: created_by, softDeletes, dan timestamps
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes(); // Persyaratan: softDeletes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loading_checks');
    }
};