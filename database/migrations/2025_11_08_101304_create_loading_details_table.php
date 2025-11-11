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
        Schema::create('loading_details', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel utama
            $table->foreignId('loading_check_id')
                  ->constrained('loading_checks')
                  ->onDelete('cascade'); // Jika form utama dihapus, detailnya ikut terhapus

            $table->string('nama_produk'); // 'Varian' di image
            $table->string('kode_produksi'); // 'Kode' di image
            $table->date('kode_expired')->nullable(); // Dari PDF
            $table->integer('jumlah');
            $table->string('keterangan')->nullable(); // Keterangan per item dari PDF

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loading_details');
    }
};