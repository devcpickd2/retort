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
        Schema::create('magnet_traps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('kode_batch');
            $table->time('pukul');
            $table->integer('jumlah_temuan');
            $table->char('status', 1); // 'v' or 'x'
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('produksi_id'); // For Operator
            $table->unsignedBigInteger('engineer_id'); // For Engineer
            $table->timestamps();

            // Opsional: Anda bisa menambahkan foreign key constraint jika memiliki tabel users/operators/engineers
            // $table->foreign('produksi_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('engineer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magnet_traps');
    }
};
