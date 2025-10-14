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
        Schema::create('gmps', function (Blueprint $table) {
           $table->id();
           $table->uuid('uuid')->unique(); 
           $table->date('date');
           $table->string('username');
           $table->string('username_updated');
           $table->string('plant');
           $table->longText('mp_chamber');
           $table->longText('karantina_packing');
           $table->longText('filling_susun');
           $table->longText('sampling_fg');
           $table->string('nama_produksi')->nullable();
           $table->string('status_produksi')->nullable();
           $table->timestamp('tgl_update_produksi')->nullable();
           $table->string('nama_spv')->nullable();
           $table->string('status_spv')->nullable();
           $table->string('catatan_spv')->nullable();
           $table->timestamp('tgl_update_spv')->nullable();
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
        Schema::dropIfExists('gmps');
    }
};
